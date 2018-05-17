#!/usr/bin/env python
# -*- coding: utf-8 -*-
import os
import sys
import shutil

absolutepath = '/var/www/html/orphee/site/epubs/'
basepath = sys.argv[1] + '/'
pathout = basepath + 'out/'

def read_identifier():
    f = open(absolutepath + basepath+'params/identifier','r')
    identifier = f.readline().strip().split(':')
    f.close()
    return identifier

def read_metadata():
    f = open(absolutepath + basepath+'params/metadata.csv','r')
    lines = f.readlines()
    f.close
    metadata = dict()
    for line in lines:
        field = line.strip().split(':')
        metadata[field[0]] = field[1]
    return metadata

def read_manifest():
    f = open(absolutepath + basepath+'params/manifest.csv','r')
    rows = [ line.strip().split(':') for line in f.readlines() ]
    f.close()
    return rows

def read_spine():
    f = open(absolutepath + basepath +'params/spine.csv','r')
    ids = f.readlines()
    f.close()
    return [ id.strip() for id in ids ]

def read_toc():
    f = open(absolutepath + basepath +'params/toc.csv','r')
    rows = [ line.strip().split(':') for line in f.readlines() ]
    f.close()
    return rows

def write_mimetype():
    f = open(absolutepath + pathout+'mimetype','w')
    f.write('application/epub+zip')
    f.close()

def write_container(content_fname):
    os.mkdir(absolutepath + pathout+'META-INF',0775)
    f = open(absolutepath + pathout+'META-INF/container.xml','w')
    f.write('<?xml version="1.0"?>\n')
    f.write('<container version="1.0" xmlns="urn:oasis:names:tc:opendocument:xmlns:container">\n')
    f.write('<rootfiles>\n')
    f.write('<rootfile full-path="'+content_fname+'" media-type="application/oebps-package+xml"/>\n')
    f.write('</rootfiles>\n')
    f.write('</container>\n')
    f.close()

def write_content(content_fname):
    f_content = open(absolutepath + pathout+content_fname,'w')
    f_content.write('<?xml version="1.0"?>\n')
    # epub 2
    f_content.write('<package xmlns="http://www.idpf.org/2007/opf" unique-identifier="dcidid" version="2.0">\n')
    # metadata: 
    f_content.write('<metadata')
    # dublin core metadata initiative
    f_content.write(' xmlns:dc="http://purl.org/dc/elements/1.1/"')
    #
    f_content.write(' xmlns:opf="http://www.idpf.org/2007/opf"')
    f_content.write(' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">\n')
    metadata = read_metadata()
    identifier = read_identifier()
    # required attrs: title, language, identifier
    f_content.write('<dc:title>'+metadata['title']+'</dc:title>\n')
    f_content.write('<dc:language xsi:type="dcterms:RFC3066">'+metadata['lang']+"</dc:language>")
    f_content.write('<dc:creator opf:role="aut">'+metadata['author']+'</dc:creator>\n')
    # scheme may be ISBN or EAN -- dcidid
    f_content.write('<dc:identifier id="dcidid" opf:scheme="'+identifier[0]+'">'+identifier[1]+'</dc:identifier>\n')

    # couverture: should be paramtrized
    cover_id = "cov_html"
    f_content.write('<meta content="cover" name="'+cover_id+'"/>\n')
    f_content.write('</metadata>\n')
    
    # manifest
    rows = read_manifest()
    f_content.write('<manifest>\n')
    # table of content
    f_content.write('<item id="ncx" href="toc.ncx" media-type="application/x-dtbncx+xml"/>\n')
    # pages
    for row in rows:
        f_content.write('<item id="'+row[0]+'" href="'+row[1]+'" media-type="'+row[2]+'"/>\n')
    f_content.write('</manifest>\n')
    
    # reader order squeleton
    ids = read_spine()
    f_content.write('<spine toc="ncx">\n')
    for id in ids :
        f_content.write('<itemref idref="'+id+'"/>\n')
    f_content.write('</spine>\n')
    # guide omited (optional)
    f_content.write('</package>\n')
    f_content.close()

def write_toc():
    rows = read_toc()
    identifier = read_identifier()
    metadata = read_metadata()
    f_toc = open(absolutepath + pathout+'toc.ncx','w')
    f_toc.write('<?xml version="1.0"?>\n')
    f_toc.write('<!DOCTYPE ncx PUBLIC "-//NISO//DTD ncx 2005-1//EN" "http://www.daisy.org/z3986/2005/ncx-2005-1.dtd">\n')
    f_toc.write('<ncx xmlns="http://www.daisy.org/z3986/2005/ncx/" version="2005-1">\n')
    f_toc.write('<head>\n')
    f_toc.write('<meta name="dtb:uid" content="'+identifier[1]+'"/>\n')
    f_toc.write('<meta name="dtb:depth" content="1"/>\n')
    # totalPageCount, maxPageNumber ?
    f_toc.write('<meta name="dtb:totalPageCount" content="0"/>\n')
    f_toc.write('<meta name="dtb:maxPageNumber" content="0"/>\n')
    f_toc.write('</head>\n')
    f_toc.write('<docTitle>\n')
    f_toc.write('<text>'+metadata['title']+'</text>\n')
    f_toc.write('</docTitle>\n')
    f_toc.write('<navMap>\n')
    order = 1
    for row in rows:
        id='navPoint-'+str(order)
        f_toc.write('<navPoint id="'+id+'" playOrder="'+str(order)+'">\n')
        f_toc.write('<navLabel><text>'+row[2]+'</text></navLabel>\n')
        f_toc.write('<content src="'+row[1]+'"/>\n')
        f_toc.write('</navPoint>\n')
        order += 1
    f_toc.write('</navMap>\n')
    f_toc.write('</ncx>\n')

def copy_files():
    for row in read_manifest():
        shutil.copyfile(absolutepath + basepath+row[1], absolutepath + pathout+row[1])


def make_all():
    os.mkdir(absolutepath + pathout,0775) 
    write_mimetype() 
    write_container('content.opf') 
    write_content('content.opf')
    write_toc() 
    copy_files()
    metadata = read_metadata()
    title = metadata['title']
    title = "_".join(title.split())
    title = eval(title)
    os.chdir(pathout)
    print(title)
    os.system('zip -X0 '+ absolutepath + pathout + title +'.epub mimetype')
    os.system('zip -Xur9D '+ absolutepath + pathout + title +'.epub *')
    print(title)
    shutil.copyfile(absolutepath + pathout + title +'.epub', absolutepath +'/'+title+'.epub')
    shutil.rmtree(absolutepath + basepath)


make_all()

    
    
