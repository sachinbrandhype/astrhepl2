$(common-objpfx)debug/noophooks.os: noophooks.c \
 ../include/stdc-predef.h \
 $(common-objpfx)libc-modules.h \
 ../include/libc-symbols.h \
 $(common-objpfx)config.h \
 ../sysdeps/generic/symbol-hacks.h ../include/libc-internal.h \
 ../sysdeps/generic/hp-timing.h

../include/stdc-predef.h:

$(common-objpfx)libc-modules.h:

../include/libc-symbols.h:

$(common-objpfx)config.h:

../sysdeps/generic/symbol-hacks.h:

../include/libc-internal.h:

../sysdeps/generic/hp-timing.h:
