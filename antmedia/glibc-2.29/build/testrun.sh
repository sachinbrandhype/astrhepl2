#!/bin/bash
builddir=`dirname "$0"`
GCONV_PATH="${builddir}/iconvdata"

usage () {
  echo "usage: $0 [--tool=strace] PROGRAM [ARGUMENTS...]" 2>&1
  echo "       $0 --tool=valgrind PROGRAM [ARGUMENTS...]" 2>&1
}

toolname=default
while test $# -gt 0 ; do
  case "$1" in
    --tool=*)
      toolname="${1:7}"
      shift
      ;;
    --*)
      usage
      ;;
    *)
      break
      ;;
  esac
done

if test $# -eq 0 ; then
  usage
fi

case "$toolname" in
  default)
    exec   env GCONV_PATH="${builddir}"/iconvdata LOCPATH="${builddir}"/localedata LC_ALL=C  "${builddir}"/elf/ld-linux-aarch64.so.1 --library-path "${builddir}":"${builddir}"/math:"${builddir}"/elf:"${builddir}"/dlfcn:"${builddir}"/nss:"${builddir}"/nis:"${builddir}"/rt:"${builddir}"/resolv:"${builddir}"/mathvec:"${builddir}"/support:"${builddir}"/crypt:"${builddir}"/nptl ${1+"$@"}
    ;;
  strace)
    exec strace  -EGCONV_PATH=/var/www/html/antmedia/glibc-2.29/build/iconvdata  -ELOCPATH=/var/www/html/antmedia/glibc-2.29/build/localedata  -ELC_ALL=C  /var/www/html/antmedia/glibc-2.29/build/elf/ld-linux-aarch64.so.1 --library-path /var/www/html/antmedia/glibc-2.29/build:/var/www/html/antmedia/glibc-2.29/build/math:/var/www/html/antmedia/glibc-2.29/build/elf:/var/www/html/antmedia/glibc-2.29/build/dlfcn:/var/www/html/antmedia/glibc-2.29/build/nss:/var/www/html/antmedia/glibc-2.29/build/nis:/var/www/html/antmedia/glibc-2.29/build/rt:/var/www/html/antmedia/glibc-2.29/build/resolv:/var/www/html/antmedia/glibc-2.29/build/mathvec:/var/www/html/antmedia/glibc-2.29/build/support:/var/www/html/antmedia/glibc-2.29/build/crypt:/var/www/html/antmedia/glibc-2.29/build/nptl ${1+"$@"}
    ;;
  valgrind)
    exec env GCONV_PATH=/var/www/html/antmedia/glibc-2.29/build/iconvdata LOCPATH=/var/www/html/antmedia/glibc-2.29/build/localedata LC_ALL=C valgrind  /var/www/html/antmedia/glibc-2.29/build/elf/ld-linux-aarch64.so.1 --library-path /var/www/html/antmedia/glibc-2.29/build:/var/www/html/antmedia/glibc-2.29/build/math:/var/www/html/antmedia/glibc-2.29/build/elf:/var/www/html/antmedia/glibc-2.29/build/dlfcn:/var/www/html/antmedia/glibc-2.29/build/nss:/var/www/html/antmedia/glibc-2.29/build/nis:/var/www/html/antmedia/glibc-2.29/build/rt:/var/www/html/antmedia/glibc-2.29/build/resolv:/var/www/html/antmedia/glibc-2.29/build/mathvec:/var/www/html/antmedia/glibc-2.29/build/support:/var/www/html/antmedia/glibc-2.29/build/crypt:/var/www/html/antmedia/glibc-2.29/build/nptl ${1+"$@"}
    ;;
  *)
    usage
    ;;
esac
