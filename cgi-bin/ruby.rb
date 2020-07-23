#!/usr/bin/ruby
require 'cgi'

cgi = CGI.new("html4")

cgi.out {
  cgi.html {
    cgi.body {
      cgi.h1 { "Test ruby CGI script" } +
      ENV.sort.collect { |k,v|
        cgi.p { "#{k}: #{v}" }
      }.to_s
    }
  }
}
