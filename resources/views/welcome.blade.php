<x-layout.base>
    <div class="bg-gray-50 text-black/30 dark:bg-black dark:text-white/30">
        <img id="background" class="absolute left-0 top-0 w-screen h-screen object-cover" src="https://cdn.glitch.global/f8dc0126-7e62-42eb-b9b3-c1d569626a06/IMG_3603.webp?v=1722094136230" />
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.5617 7C19.7904 5.69523 18.7863 4.5 17.4617 4.5H6.53788C5.21323 4.5 4.20922 5.69523 4.43784 7" stroke="#1C274C" stroke-width="1.5"/>
                        <path d="M17.4999 4.5C17.5283 4.24092 17.5425 4.11135 17.5427 4.00435C17.545 2.98072 16.7739 2.12064 15.7561 2.01142C15.6497 2 15.5194 2 15.2588 2H8.74099C8.48035 2 8.35002 2 8.24362 2.01142C7.22584 2.12064 6.45481 2.98072 6.45704 4.00434C6.45727 4.11135 6.47146 4.2409 6.49983 4.5" stroke="#1C274C" stroke-width="1.5"/>
                        <path d="M15 18H9" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M21.1935 16.793C20.8437 19.2739 20.6689 20.5143 19.7717 21.2572C18.8745 22 17.5512 22 14.9046 22H9.09536C6.44881 22 5.12553 22 4.22834 21.2572C3.33115 20.5143 3.15626 19.2739 2.80648 16.793L2.38351 13.793C1.93748 10.6294 1.71447 9.04765 2.66232 8.02383C3.61017 7 5.29758 7 8.67239 7H15.3276C18.7024 7 20.3898 7 21.3377 8.02383C22.0865 8.83268 22.1045 9.98979 21.8592 12" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    </div>
                    @if (Route::has('login'))
                        <livewire:welcome.navigation />
                    @endif
                </header>

                <main class="mt-6">
                    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                        <a
                            href="https://www.cancun.tecnm.mx/"
                            id="bitacora-card"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/90 hover:ring-black/10 hover:scale-105 focus:outline-none focus-visible:ring-[#07304C] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#07304C]"
                        >
                            <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                                <img
                                    src="https://cdn.glitch.global/f8dc0126-7e62-42eb-b9b3-c1d569626a06/by-gatovsky.svg?v=1734262193816"
                                    alt="Bitacora by Gatovsky"
                                    class="aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.06)] dark:hidden"
                                    onerror="
                                        document.getElementById('screenshot-container').classList.add('!hidden');
                                        document.getElementById('docs-card').classList.add('!row-span-1');
                                        document.getElementById('docs-card-content').classList.add('!flex-row');
                                        document.getElementById('background').classList.add('!hidden');
                                    "
                                />
                                <img
                                    src="https://cdn.glitch.global/f8dc0126-7e62-42eb-b9b3-c1d569626a06/by-gatovsky.svg?v=1734262193816"
                                    alt="Bitacora by Gatovsky"
                                    class="hidden aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] dark:block"
                                />
                                <div
                                    class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900"
                                ></div>
                            </div>

                            <div class="relative flex items-center gap-6 lg:items-end">
                                <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">

                                    <div class="pt-3 sm:pt-5 lg:pt-0">
                                        <h2 class="text-xl font-semibold text-black dark:text-white">Sistema de Bitácora</h2>

                                        <p class="mt-4 text-sm/relaxed">
                                            Sistema de bitacora digital para el control de entradas y salidas de artículos en el <span class="font-semibold">Instituto Tecnológico de Cancún</span>.

                                            Este sistema permite gestionar de manera eficiente el inventario, facilitando el registro detallado de cada movimiento y garantizando un seguimiento preciso de todos los artículos institucionales.
                                        </p>
                                    </div>
                                </div>
                                <svg class="size-6 shrink-0 self-center stroke-[#118AB2]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                            </div>
                        </a>

                        <a
                            href="#"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#118AB2] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#118AB2]"
                        >
                            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#118AB2]/10 sm:size-16">
                                
                                <svg fill="#118AB2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M.221 16.268a15.064 15.064 0 0 0 1.789 1.9C2.008 18.111 2 18.057 2 18a5.029 5.029 0 0 1 3.233-4.678 1 1 0 0 0 .175-1.784A2.968 2.968 0 0 1 4 9a2.988 2.988 0 0 1 5.022-2.2 5.951 5.951 0 0 1 2.022-.715 4.994 4.994 0 1 0-7.913 6.085 7.07 7.07 0 0 0-2.91 4.098zM23.779 16.268a7.07 7.07 0 0 0-2.91-4.1 4.994 4.994 0 1 0-7.913-6.086 5.949 5.949 0 0 1 2.022.715 2.993 2.993 0 1 1 3.614 4.74 1 1 0 0 0 .175 1.784A5.029 5.029 0 0 1 22 18c0 .057-.008.111-.01.167a15.065 15.065 0 0 0 1.789-1.899z"/>
                                    <path d="M18.954 20.284a7.051 7.051 0 0 0-3.085-5.114A4.956 4.956 0 0 0 17 12a5 5 0 1 0-8.869 3.17 7.051 7.051 0 0 0-3.085 5.114 14.923 14.923 0 0 0 1.968.849C7.012 21.088 7 21.046 7 21a5.031 5.031 0 0 1 3.233-4.678 1 1 0 0 0 .175-1.785A2.964 2.964 0 0 1 9 12a3 3 0 1 1 6 0 2.964 2.964 0 0 1-1.408 2.537 1 1 0 0 0 .175 1.785A5.031 5.031 0 0 1 17 21c0 .046-.012.088-.013.133a14.919 14.919 0 0 0 1.967-.849z"/>
                                </svg>
                            </div>

                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black dark:text-white">Gestiona</h2>

                                <p class="mt-4 text-sm/relaxed">
                                    Administra de manera integral el sistema mediante un robusto control de usuarios, roles y permisos. Gestiona con total seguridad la base de datos de artículos, permitiendo crear, modificar y dar de baja registros según las necesidades institucionales.
                                </p>
                            </div>
                        </a>

                        <a
                            href="#"
                            class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#118AB2] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#118AB2]"
                        >
                            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#118AB2]/10 sm:size-16">
                                <svg fill="#118AB2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 5h-4V4a1 1 0 0 0-2 0v1h-4V4a1 1 0 0 0-2 0v1H4a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1zM8 7v.5a1 1 0 0 0 2 0V7h4v.5a1 1 0 0 0 2 0V7h3v3H5V7h3zM5 18v-6h14v6H5z"/>
                                </svg>
                            </div>

                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black dark:text-white">Requisiciones</h2>

                                <p class="mt-4 text-sm/relaxed">
                                    Ten el control de las requisiciones de artículos, permitiendo la creación de solicitudes detalladas y el seguimiento de las mismas.
                                </p>
                            </div>
                        </a>

                        <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#118AB2]/10 sm:size-16">
                                <svg fill="#118AB2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 20a1 1 0 0 1-.437-.1C11.214 19.73 3 15.671 3 9a5 5 0 0 1 8.535-3.536l.465.465.465-.465A5 5 0 0 1 21 9c0 6.646-8.212 10.728-8.562 10.9A1 1 0 0 1 12 20z"/>
                                </svg>
                            </div>

                            <div class="pt-3 sm:pt-5">
                                <h2 class="text-xl font-semibold text-black dark:text-white">Funcionalidades</h2>

                                <p class="mt-4 text-sm/relaxed">
                                    Permite la búsqueda avanzada de artículos por departamento, por fechas, tipo de artículo, estado, etc.
                                </p>
                            </div>
                        </div>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    Gatovsky 2024 - Todos los derechos reservados
                </footer>
            </div>
        </div>
    </div>
</x-layout.base>