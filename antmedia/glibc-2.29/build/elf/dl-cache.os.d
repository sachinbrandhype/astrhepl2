$(common-objpfx)elf/dl-cache.os: dl-cache.c \
 ../include/stdc-predef.h \
 $(common-objpfx)libc-modules.h \
 ../include/libc-symbols.h \
 $(common-objpfx)config.h \
 ../sysdeps/generic/symbol-hacks.h ../include/assert.h ../assert/assert.h \
 ../include/features.h ../include/sys/cdefs.h ../misc/sys/cdefs.h \
 ../sysdeps/aarch64/bits/wordsize.h \
 ../sysdeps/ieee754/ldbl-128/bits/long-double.h ../include/gnu/stubs.h \
 ../include/unistd.h ../posix/unistd.h \
 ../sysdeps/unix/sysv/linux/bits/posix_opt.h ../bits/environments.h \
 ../include/bits/types.h ../posix/bits/types.h ../bits/timesize.h \
 ../sysdeps/unix/sysv/linux/generic/bits/typesizes.h ../bits/time64.h \
 /usr/lib/gcc/aarch64-linux-gnu/7/include/stddef.h ../bits/confname.h \
 ../include/bits/getopt_posix.h ../posix/bits/getopt_posix.h \
 ../include/bits/getopt_core.h ../posix/bits/getopt_core.h \
 ../sysdeps/generic/dl-unistd.h \
 ../sysdeps/unix/sysv/linux/aarch64/ldsodefs.h \
 ../sysdeps/unix/sysv/linux/ldsodefs.h ../sysdeps/gnu/ldsodefs.h \
 ../include/elf.h ../elf/elf.h ../sysdeps/generic/stdint.h \
 ../bits/libc-header-start.h ../bits/wchar.h ../bits/stdint-intn.h \
 ../bits/stdint-uintn.h ../include/libc-pointer-arith.h \
 ../sysdeps/generic/dl-dtprocnum.h \
 $(common-objpfx)libc-abis.h ../include/string.h \
 ../include/sys/types.h ../posix/sys/types.h \
 ../include/bits/types/clock_t.h ../time/bits/types/clock_t.h \
 ../include/bits/types/clockid_t.h ../time/bits/types/clockid_t.h \
 ../include/bits/types/time_t.h ../time/bits/types/time_t.h \
 ../include/bits/types/timer_t.h ../time/bits/types/timer_t.h \
 ../include/endian.h ../string/endian.h ../sysdeps/aarch64/bits/endian.h \
 ../bits/byteswap.h ../bits/uintn-identity.h ../include/sys/select.h \
 ../misc/sys/select.h ../bits/select.h ../include/bits/types/sigset_t.h \
 ../signal/bits/types/sigset_t.h \
 ../sysdeps/unix/sysv/linux/bits/types/__sigset_t.h \
 ../include/bits/types/struct_timeval.h \
 ../time/bits/types/struct_timeval.h \
 ../include/bits/types/struct_timespec.h \
 ../time/bits/types/struct_timespec.h ../sysdeps/nptl/bits/pthreadtypes.h \
 ../sysdeps/nptl/bits/thread-shared-types.h \
 ../sysdeps/aarch64/nptl/bits/pthreadtypes-arch.h \
 ../sysdeps/aarch64/string_private.h ../string/string.h \
 ../include/bits/types/locale_t.h ../locale/bits/types/locale_t.h \
 ../include/bits/types/__locale_t.h ../locale/bits/types/__locale_t.h \
 ../include/strings.h ../string/strings.h ../sysdeps/aarch64/ldsodefs.h \
 ../sysdeps/unix/sysv/linux/aarch64/cpu-features.h \
 ../sysdeps/generic/ldsodefs.h \
 /usr/lib/gcc/aarch64-linux-gnu/7/include/stdbool.h ../include/dlfcn.h \
 ../dlfcn/dlfcn.h ../include/bits/dlfcn.h ../bits/dlfcn.h \
 ../include/link.h ../elf/link.h ../bits/elfclass.h \
 ../sysdeps/aarch64/bits/link.h ../sysdeps/aarch64/linkmap.h \
 ../sysdeps/posix/dl-fileid.h ../include/sys/stat.h ../io/sys/stat.h \
 ../sysdeps/unix/sysv/linux/generic/bits/stat.h ../include/bits/statx.h \
 ../io/bits/statx.h ../sysdeps/generic/dl-lookupcfg.h \
 ../sysdeps/aarch64/nptl/tls.h ../sysdeps/unix/sysv/linux/dl-sysdep.h \
 ../sysdeps/aarch64/dl-sysdep.h ../sysdeps/generic/dl-sysdep.h \
 ../sysdeps/generic/dl-dtv.h ../sysdeps/unix/sysv/linux/aarch64/sysdep.h \
 ../sysdeps/unix/sysdep.h ../sysdeps/generic/sysdep.h \
 ../sysdeps/generic/dwarf2.h ../sysdeps/unix/sysv/linux/sys/syscall.h \
 /usr/include/aarch64-linux-gnu/asm/unistd.h \
 /usr/include/asm-generic/unistd.h \
 /usr/include/aarch64-linux-gnu/asm/bitsperlong.h \
 /usr/include/asm-generic/bitsperlong.h ../sysdeps/aarch64/sysdep.h \
 ../sysdeps/unix/sysv/linux/generic/sysdep.h \
 ../sysdeps/unix/sysv/linux/aarch64/kernel-features.h \
 ../sysdeps/unix/sysv/linux/kernel-features.h \
 ../sysdeps/unix/sysv/linux/sysdep.h ../include/errno.h ../stdlib/errno.h \
 ../sysdeps/unix/sysv/linux/bits/errno.h /usr/include/linux/errno.h \
 /usr/include/aarch64-linux-gnu/asm/errno.h \
 /usr/include/asm-generic/errno.h /usr/include/asm-generic/errno-base.h \
 ../bits/types/error_t.h ../nptl/descr.h ../include/limits.h \
 /usr/lib/gcc/aarch64-linux-gnu/7/include-fixed/limits.h \
 ../include/bits/posix1_lim.h ../posix/bits/posix1_lim.h \
 ../sysdeps/unix/sysv/linux/aarch64/bits/local_lim.h \
 /usr/include/linux/limits.h ../include/bits/posix2_lim.h \
 ../posix/bits/posix2_lim.h ../include/bits/xopen_lim.h \
 ../sysdeps/unix/sysv/linux/bits/uio_lim.h ../include/sched.h \
 ../posix/sched.h ../sysdeps/unix/sysv/linux/bits/sched.h \
 ../bits/types/struct_sched_param.h ../include/bits/cpu-set.h \
 ../posix/bits/cpu-set.h ../include/setjmp.h ../setjmp/setjmp.h \
 ../sysdeps/aarch64/bits/setjmp.h \
 ../sysdeps/unix/sysv/linux/aarch64/jmp_buf-macros.h \
 ../sysdeps/generic/hp-timing.h ../include/list_t.h \
 ../sysdeps/nptl/lowlevellock.h ../include/atomic.h ../include/stdlib.h \
 ../stdlib/stdlib.h ../sysdeps/unix/sysv/linux/bits/waitflags.h \
 ../bits/waitstatus.h ../sysdeps/ieee754/ldbl-128/bits/floatn.h \
 ../bits/floatn-common.h ../include/alloca.h ../stdlib/alloca.h \
 ../include/stackinfo.h ../sysdeps/aarch64/stackinfo.h \
 ../sysdeps/pthread/allocalim.h ../bits/stdlib-bsearch.h \
 ../include/bits/stdlib-float.h ../sysdeps/aarch64/atomic-machine.h \
 ../sysdeps/unix/sysv/linux/lowlevellock-futex.h \
 ../sysdeps/aarch64/nptl/pthreaddef.h ../nptl/../nptl_db/thread_db.h \
 ../include/pthread.h ../sysdeps/nptl/pthread.h ../include/time.h \
 ../time/time.h ../sysdeps/unix/sysv/linux/bits/time.h \
 ../sysdeps/unix/sysv/linux/bits/timex.h \
 ../include/bits/types/struct_tm.h ../time/bits/types/struct_tm.h \
 ../include/bits/types/struct_itimerspec.h \
 ../time/bits/types/struct_itimerspec.h \
 ../sysdeps/unix/sysv/linux/sys/procfs.h ../include/sys/time.h \
 ../time/sys/time.h ../sysdeps/unix/sysv/linux/aarch64/sys/user.h \
 ../sysdeps/unix/sysv/linux/aarch64/bits/procfs.h \
 ../sysdeps/unix/sysv/linux/bits/procfs-id.h \
 ../sysdeps/unix/sysv/linux/bits/procfs-prregset.h \
 ../sysdeps/unix/sysv/linux/bits/procfs-extra.h \
 ../sysdeps/generic/unwind.h ../include/bits/types/res_state.h \
 ../resolv/bits/types/res_state.h ../include/netinet/in.h \
 ../inet/netinet/in.h ../include/sys/socket.h ../socket/sys/socket.h \
 ../include/bits/types/struct_iovec.h ../misc/bits/types/struct_iovec.h \
 ../sysdeps/unix/sysv/linux/bits/socket.h \
 ../sysdeps/unix/sysv/linux/bits/socket_type.h ../bits/sockaddr.h \
 /usr/include/aarch64-linux-gnu/asm/socket.h \
 /usr/include/asm-generic/socket.h \
 /usr/include/aarch64-linux-gnu/asm/sockios.h \
 /usr/include/asm-generic/sockios.h \
 ../include/bits/types/struct_osockaddr.h \
 ../socket/bits/types/struct_osockaddr.h \
 ../sysdeps/unix/sysv/linux/bits/in.h ../sysdeps/nptl/libc-lock.h \
 ../sysdeps/nptl/libc-lockP.h ../sysdeps/nptl/pthread-functions.h \
 ../sysdeps/nptl/internaltypes.h ../sysdeps/generic/link_map.h \
 ../include/fpu_control.h ../sysdeps/aarch64/fpu/fpu_control.h \
 ../include/sys/mman.h ../misc/sys/mman.h \
 ../sysdeps/unix/sysv/linux/bits/mman.h \
 ../sysdeps/unix/sysv/linux/bits/mman-map-flags-generic.h \
 ../sysdeps/unix/sysv/linux/bits/mman-linux.h \
 ../sysdeps/unix/sysv/linux/bits/mman-shared.h \
 ../sysdeps/generic/dl-mman.h ../sysdeps/generic/dl-procruntime.c \
 ../sysdeps/unix/sysv/linux/aarch64/dl-procinfo.c \
 ../sysdeps/unix/sysv/linux/aarch64/dl-cache.h \
 ../sysdeps/unix/sysv/linux/aarch64/ldconfig.h \
 ../sysdeps/generic/ldconfig.h ../include/programs/xmalloc.h \
 ../sysdeps/generic/dl-cache.h \
 ../sysdeps/unix/sysv/linux/aarch64/dl-procinfo.h ../include/sys/auxv.h \
 ../misc/sys/auxv.h ../sysdeps/unix/sysv/linux/aarch64/bits/hwcap.h \
 ../sysdeps/generic/_itoa.h dl-hwcaps.h ../elf/dl-tunables.h \
 ../elf/dl-tunable-types.h \
 $(common-objpfx)dl-tunable-list.h

../include/stdc-predef.h:

$(common-objpfx)libc-modules.h:

../include/libc-symbols.h:

$(common-objpfx)config.h:

../sysdeps/generic/symbol-hacks.h:

../include/assert.h:

../assert/assert.h:

../include/features.h:

../include/sys/cdefs.h:

../misc/sys/cdefs.h:

../sysdeps/aarch64/bits/wordsize.h:

../sysdeps/ieee754/ldbl-128/bits/long-double.h:

../include/gnu/stubs.h:

../include/unistd.h:

../posix/unistd.h:

../sysdeps/unix/sysv/linux/bits/posix_opt.h:

../bits/environments.h:

../include/bits/types.h:

../posix/bits/types.h:

../bits/timesize.h:

../sysdeps/unix/sysv/linux/generic/bits/typesizes.h:

../bits/time64.h:

/usr/lib/gcc/aarch64-linux-gnu/7/include/stddef.h:

../bits/confname.h:

../include/bits/getopt_posix.h:

../posix/bits/getopt_posix.h:

../include/bits/getopt_core.h:

../posix/bits/getopt_core.h:

../sysdeps/generic/dl-unistd.h:

../sysdeps/unix/sysv/linux/aarch64/ldsodefs.h:

../sysdeps/unix/sysv/linux/ldsodefs.h:

../sysdeps/gnu/ldsodefs.h:

../include/elf.h:

../elf/elf.h:

../sysdeps/generic/stdint.h:

../bits/libc-header-start.h:

../bits/wchar.h:

../bits/stdint-intn.h:

../bits/stdint-uintn.h:

../include/libc-pointer-arith.h:

../sysdeps/generic/dl-dtprocnum.h:

$(common-objpfx)libc-abis.h:

../include/string.h:

../include/sys/types.h:

../posix/sys/types.h:

../include/bits/types/clock_t.h:

../time/bits/types/clock_t.h:

../include/bits/types/clockid_t.h:

../time/bits/types/clockid_t.h:

../include/bits/types/time_t.h:

../time/bits/types/time_t.h:

../include/bits/types/timer_t.h:

../time/bits/types/timer_t.h:

../include/endian.h:

../string/endian.h:

../sysdeps/aarch64/bits/endian.h:

../bits/byteswap.h:

../bits/uintn-identity.h:

../include/sys/select.h:

../misc/sys/select.h:

../bits/select.h:

../include/bits/types/sigset_t.h:

../signal/bits/types/sigset_t.h:

../sysdeps/unix/sysv/linux/bits/types/__sigset_t.h:

../include/bits/types/struct_timeval.h:

../time/bits/types/struct_timeval.h:

../include/bits/types/struct_timespec.h:

../time/bits/types/struct_timespec.h:

../sysdeps/nptl/bits/pthreadtypes.h:

../sysdeps/nptl/bits/thread-shared-types.h:

../sysdeps/aarch64/nptl/bits/pthreadtypes-arch.h:

../sysdeps/aarch64/string_private.h:

../string/string.h:

../include/bits/types/locale_t.h:

../locale/bits/types/locale_t.h:

../include/bits/types/__locale_t.h:

../locale/bits/types/__locale_t.h:

../include/strings.h:

../string/strings.h:

../sysdeps/aarch64/ldsodefs.h:

../sysdeps/unix/sysv/linux/aarch64/cpu-features.h:

../sysdeps/generic/ldsodefs.h:

/usr/lib/gcc/aarch64-linux-gnu/7/include/stdbool.h:

../include/dlfcn.h:

../dlfcn/dlfcn.h:

../include/bits/dlfcn.h:

../bits/dlfcn.h:

../include/link.h:

../elf/link.h:

../bits/elfclass.h:

../sysdeps/aarch64/bits/link.h:

../sysdeps/aarch64/linkmap.h:

../sysdeps/posix/dl-fileid.h:

../include/sys/stat.h:

../io/sys/stat.h:

../sysdeps/unix/sysv/linux/generic/bits/stat.h:

../include/bits/statx.h:

../io/bits/statx.h:

../sysdeps/generic/dl-lookupcfg.h:

../sysdeps/aarch64/nptl/tls.h:

../sysdeps/unix/sysv/linux/dl-sysdep.h:

../sysdeps/aarch64/dl-sysdep.h:

../sysdeps/generic/dl-sysdep.h:

../sysdeps/generic/dl-dtv.h:

../sysdeps/unix/sysv/linux/aarch64/sysdep.h:

../sysdeps/unix/sysdep.h:

../sysdeps/generic/sysdep.h:

../sysdeps/generic/dwarf2.h:

../sysdeps/unix/sysv/linux/sys/syscall.h:

/usr/include/aarch64-linux-gnu/asm/unistd.h:

/usr/include/asm-generic/unistd.h:

/usr/include/aarch64-linux-gnu/asm/bitsperlong.h:

/usr/include/asm-generic/bitsperlong.h:

../sysdeps/aarch64/sysdep.h:

../sysdeps/unix/sysv/linux/generic/sysdep.h:

../sysdeps/unix/sysv/linux/aarch64/kernel-features.h:

../sysdeps/unix/sysv/linux/kernel-features.h:

../sysdeps/unix/sysv/linux/sysdep.h:

../include/errno.h:

../stdlib/errno.h:

../sysdeps/unix/sysv/linux/bits/errno.h:

/usr/include/linux/errno.h:

/usr/include/aarch64-linux-gnu/asm/errno.h:

/usr/include/asm-generic/errno.h:

/usr/include/asm-generic/errno-base.h:

../bits/types/error_t.h:

../nptl/descr.h:

../include/limits.h:

/usr/lib/gcc/aarch64-linux-gnu/7/include-fixed/limits.h:

../include/bits/posix1_lim.h:

../posix/bits/posix1_lim.h:

../sysdeps/unix/sysv/linux/aarch64/bits/local_lim.h:

/usr/include/linux/limits.h:

../include/bits/posix2_lim.h:

../posix/bits/posix2_lim.h:

../include/bits/xopen_lim.h:

../sysdeps/unix/sysv/linux/bits/uio_lim.h:

../include/sched.h:

../posix/sched.h:

../sysdeps/unix/sysv/linux/bits/sched.h:

../bits/types/struct_sched_param.h:

../include/bits/cpu-set.h:

../posix/bits/cpu-set.h:

../include/setjmp.h:

../setjmp/setjmp.h:

../sysdeps/aarch64/bits/setjmp.h:

../sysdeps/unix/sysv/linux/aarch64/jmp_buf-macros.h:

../sysdeps/generic/hp-timing.h:

../include/list_t.h:

../sysdeps/nptl/lowlevellock.h:

../include/atomic.h:

../include/stdlib.h:

../stdlib/stdlib.h:

../sysdeps/unix/sysv/linux/bits/waitflags.h:

../bits/waitstatus.h:

../sysdeps/ieee754/ldbl-128/bits/floatn.h:

../bits/floatn-common.h:

../include/alloca.h:

../stdlib/alloca.h:

../include/stackinfo.h:

../sysdeps/aarch64/stackinfo.h:

../sysdeps/pthread/allocalim.h:

../bits/stdlib-bsearch.h:

../include/bits/stdlib-float.h:

../sysdeps/aarch64/atomic-machine.h:

../sysdeps/unix/sysv/linux/lowlevellock-futex.h:

../sysdeps/aarch64/nptl/pthreaddef.h:

../nptl/../nptl_db/thread_db.h:

../include/pthread.h:

../sysdeps/nptl/pthread.h:

../include/time.h:

../time/time.h:

../sysdeps/unix/sysv/linux/bits/time.h:

../sysdeps/unix/sysv/linux/bits/timex.h:

../include/bits/types/struct_tm.h:

../time/bits/types/struct_tm.h:

../include/bits/types/struct_itimerspec.h:

../time/bits/types/struct_itimerspec.h:

../sysdeps/unix/sysv/linux/sys/procfs.h:

../include/sys/time.h:

../time/sys/time.h:

../sysdeps/unix/sysv/linux/aarch64/sys/user.h:

../sysdeps/unix/sysv/linux/aarch64/bits/procfs.h:

../sysdeps/unix/sysv/linux/bits/procfs-id.h:

../sysdeps/unix/sysv/linux/bits/procfs-prregset.h:

../sysdeps/unix/sysv/linux/bits/procfs-extra.h:

../sysdeps/generic/unwind.h:

../include/bits/types/res_state.h:

../resolv/bits/types/res_state.h:

../include/netinet/in.h:

../inet/netinet/in.h:

../include/sys/socket.h:

../socket/sys/socket.h:

../include/bits/types/struct_iovec.h:

../misc/bits/types/struct_iovec.h:

../sysdeps/unix/sysv/linux/bits/socket.h:

../sysdeps/unix/sysv/linux/bits/socket_type.h:

../bits/sockaddr.h:

/usr/include/aarch64-linux-gnu/asm/socket.h:

/usr/include/asm-generic/socket.h:

/usr/include/aarch64-linux-gnu/asm/sockios.h:

/usr/include/asm-generic/sockios.h:

../include/bits/types/struct_osockaddr.h:

../socket/bits/types/struct_osockaddr.h:

../sysdeps/unix/sysv/linux/bits/in.h:

../sysdeps/nptl/libc-lock.h:

../sysdeps/nptl/libc-lockP.h:

../sysdeps/nptl/pthread-functions.h:

../sysdeps/nptl/internaltypes.h:

../sysdeps/generic/link_map.h:

../include/fpu_control.h:

../sysdeps/aarch64/fpu/fpu_control.h:

../include/sys/mman.h:

../misc/sys/mman.h:

../sysdeps/unix/sysv/linux/bits/mman.h:

../sysdeps/unix/sysv/linux/bits/mman-map-flags-generic.h:

../sysdeps/unix/sysv/linux/bits/mman-linux.h:

../sysdeps/unix/sysv/linux/bits/mman-shared.h:

../sysdeps/generic/dl-mman.h:

../sysdeps/generic/dl-procruntime.c:

../sysdeps/unix/sysv/linux/aarch64/dl-procinfo.c:

../sysdeps/unix/sysv/linux/aarch64/dl-cache.h:

../sysdeps/unix/sysv/linux/aarch64/ldconfig.h:

../sysdeps/generic/ldconfig.h:

../include/programs/xmalloc.h:

../sysdeps/generic/dl-cache.h:

../sysdeps/unix/sysv/linux/aarch64/dl-procinfo.h:

../include/sys/auxv.h:

../misc/sys/auxv.h:

../sysdeps/unix/sysv/linux/aarch64/bits/hwcap.h:

../sysdeps/generic/_itoa.h:

dl-hwcaps.h:

../elf/dl-tunables.h:

../elf/dl-tunable-types.h:

$(common-objpfx)dl-tunable-list.h:
