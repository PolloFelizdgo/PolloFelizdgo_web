@extends('panel.layouts.app')

@section('title', $title)

@section('content')
    @php
        $initialPayload = is_array($payload ?? null) ? $payload : [];
        $themeDefaults = is_array(config('site_content.theme')) ? config('site_content.theme') : [];
        $oldPayloadJson = old('payload_json');
        $isVisualSection = in_array($section, ['home.content', 'about.content', 'footer.copy', 'menu.items', 'theme.settings'], true);

        if (is_string($oldPayloadJson) && $oldPayloadJson !== '') {
            $decodedOldPayload = json_decode($oldPayloadJson, true);

            if (is_array($decodedOldPayload)) {
                $initialPayload = $decodedOldPayload;
            }
        }
    @endphp

    <div class="mb-7 panel-card p-6">
        <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight">{{ $title }}</h2>
        <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm md:text-base">
            @if($isVisualSection)
                Editor visual activo. Puedes cambiar contenido sin tocar JSON.
            @else
                Edita JSON de la seccion, guarda borrador y publica cuando estes listo.
            @endif
        </p>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-xl border border-green-300 bg-green-50 text-green-800 px-4 py-3 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 rounded-xl border border-red-300 bg-red-50 text-red-700 px-4 py-3 shadow-sm">
            <p class="font-semibold mb-2">Revisa lo siguiente:</p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="panel-card p-5 mb-6">
        <p class="text-xs uppercase tracking-[0.18em] text-gray-500">Seccion</p>
        <p class="font-semibold mt-1">{{ $section }}</p>
        @if($isVisualSection)
            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Tip: puedes arrastrar y soltar tarjetas para reordenarlas.</p>
        @endif
    </div>

    <div id="unsavedChangesNotice" class="hidden mb-4 rounded-xl border border-amber-300 bg-amber-50 text-amber-800 px-4 py-3">
        Tienes cambios sin guardar en esta seccion.
    </div>

    <form id="draftContentForm" method="POST" action="{{ match($section) {
        'home.content' => route('panel.content.home.update'),
        'about.content' => route('panel.content.about.update'),
        'footer.copy' => route('panel.content.footer.update'),
        'menu.items' => route('panel.content.menu.update'),
        'theme.settings' => route('panel.content.theme.update'),
        default => '#'
    } }}" class="space-y-4">
        @csrf
        @method('PUT')

        @if($isVisualSection)
            <input type="hidden" id="payload_json" name="payload_json" value="{{ old('payload_json', $payloadJson) }}">

            <div
                id="visualContentEditor"
                class="space-y-6"
                data-section="{{ $section }}"
                data-upload-url="{{ route('panel.content.upload-image') }}"
                data-csrf="{{ csrf_token() }}"
                data-initial='@json($initialPayload)'
                data-theme-defaults='@json($themeDefaults)'
            >
                @if($section === 'home.content')
                    <section class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5">
                        <div class="flex items-center justify-between gap-3 mb-4">
                            <div>
                                <h3 class="text-xl font-bold">Hero principal</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Slides del encabezado de inicio.</p>
                            </div>
                            <button type="button" data-add="hero" class="inline-flex items-center rounded-full bg-gray-900 hover:bg-black text-white dark:bg-gray-100 dark:text-gray-900 dark:hover:bg-white font-semibold px-4 py-2">Agregar slide</button>
                        </div>
                        <div data-list="hero" class="space-y-4"></div>
                    </section>

                    <section class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5">
                        <div class="flex items-center justify-between gap-3 mb-4">
                            <div>
                                <h3 class="text-xl font-bold">Promociones</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Tarjetas de promociones semanales.</p>
                            </div>
                            <button type="button" data-add="promotions" class="inline-flex items-center rounded-full bg-gray-900 hover:bg-black text-white dark:bg-gray-100 dark:text-gray-900 dark:hover:bg-white font-semibold px-4 py-2">Agregar promocion</button>
                        </div>
                        <div data-list="promotions" class="space-y-4"></div>
                    </section>

                    <section class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5">
                        <div class="flex items-center justify-between gap-3 mb-4">
                            <div>
                                <h3 class="text-xl font-bold">Testimonios</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Resenas mostradas en Home.</p>
                            </div>
                            <button type="button" data-add="testimonials" class="inline-flex items-center rounded-full bg-gray-900 hover:bg-black text-white dark:bg-gray-100 dark:text-gray-900 dark:hover:bg-white font-semibold px-4 py-2">Agregar testimonio</button>
                        </div>
                        <div data-list="testimonials" class="space-y-4"></div>
                    </section>
                @endif

                @if($section === 'about.content')
                    <section class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5 space-y-4">
                        <h3 class="text-xl font-bold">Resumen de Acerca</h3>
                        <div class="grid md:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-semibold mb-1" for="about_summary_label">Etiqueta</label>
                                <input id="about_summary_label" type="text" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1" for="about_summary_button">Texto boton</label>
                                <input id="about_summary_button" type="text" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1" for="about_summary_title">Titulo</label>
                            <input id="about_summary_title" type="text" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1" for="about_summary_image">Imagen resumen (ruta)</label>
                            <div class="flex flex-wrap items-center gap-2">
                                <input id="about_summary_image" type="text" class="flex-1 min-w-[220px] rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                <button type="button" data-upload-target-id="about_summary_image" class="inline-flex items-center rounded-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2">Subir imagen</button>
                                <input data-upload-for="about_summary_image" type="file" accept="image/*" class="hidden">
                            </div>
                            <img id="about_summary_image_preview" src="" alt="Preview resumen" class="mt-2 hidden h-16 w-28 rounded object-cover border border-gray-200 dark:border-gray-700">
                        </div>
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <label class="block text-sm font-semibold">Parrafos</label>
                                <button type="button" data-add="aboutParagraphs" class="inline-flex items-center rounded-full bg-gray-900 hover:bg-black text-white dark:bg-gray-100 dark:text-gray-900 dark:hover:bg-white font-semibold px-4 py-2">Agregar parrafo</button>
                            </div>
                            <div data-list="aboutParagraphs" class="space-y-3"></div>
                        </div>
                    </section>

                    <section class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5 space-y-4">
                        <h3 class="text-xl font-bold">Imagenes corporativas</h3>
                        <div class="grid md:grid-cols-2 gap-3">
                            @foreach(['hero' => 'Hero', 'history' => 'Historia', 'mission' => 'Mision', 'vision' => 'Vision'] as $key => $label)
                                <div>
                                    <label class="block text-sm font-semibold mb-1" for="about_image_{{ $key }}">{{ $label }}</label>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <input id="about_image_{{ $key }}" type="text" class="flex-1 min-w-[180px] rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2" data-about-image-key="{{ $key }}">
                                        <button type="button" data-upload-target-id="about_image_{{ $key }}" class="inline-flex items-center rounded-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2">Subir imagen</button>
                                        <input data-upload-for="about_image_{{ $key }}" type="file" accept="image/*" class="hidden">
                                    </div>
                                    <img id="about_image_{{ $key }}_preview" src="" alt="Preview {{ $label }}" class="mt-2 hidden h-16 w-28 rounded object-cover border border-gray-200 dark:border-gray-700">
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5">
                        <div class="flex items-center justify-between gap-3 mb-4">
                            <div>
                                <h3 class="text-xl font-bold">Linea de tiempo</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Hitos historicos de la marca.</p>
                            </div>
                            <button type="button" data-add="timeline" class="inline-flex items-center rounded-full bg-gray-900 hover:bg-black text-white dark:bg-gray-100 dark:text-gray-900 dark:hover:bg-white font-semibold px-4 py-2">Agregar hito</button>
                        </div>
                        <div data-list="timeline" class="space-y-4"></div>
                    </section>

                    <section class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5">
                        <div class="flex items-center justify-between gap-3 mb-4">
                            <div>
                                <h3 class="text-xl font-bold">Valores institucionales</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Tarjetas de valores en pagina Acerca.</p>
                            </div>
                            <button type="button" data-add="values" class="inline-flex items-center rounded-full bg-gray-900 hover:bg-black text-white dark:bg-gray-100 dark:text-gray-900 dark:hover:bg-white font-semibold px-4 py-2">Agregar valor</button>
                        </div>
                        <div data-list="values" class="space-y-4"></div>
                    </section>
                @endif

                @if($section === 'footer.copy')
                    <section class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5 space-y-4">
                        <h3 class="text-xl font-bold">Contenido del Footer</h3>
                        <div>
                            <label class="block text-sm font-semibold mb-1" for="footer_cta_label">Etiqueta CTA</label>
                            <input id="footer_cta_label" type="text" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1" for="footer_cta_title">Titulo CTA</label>
                            <input id="footer_cta_title" type="text" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1" for="footer_brand_description">Descripcion de marca</label>
                            <textarea id="footer_brand_description" rows="4" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2"></textarea>
                        </div>
                    </section>
                @endif

                @if($section === 'menu.items')
                    <section class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5">
                        <div class="flex items-center justify-between gap-3 mb-4">
                            <div>
                                <h3 class="text-xl font-bold">Menu: platillo y precio</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Edita solo nombre del platillo y precio.</p>
                            </div>
                            <button type="button" data-add="menuItems" class="inline-flex items-center rounded-full bg-gray-900 hover:bg-black text-white dark:bg-gray-100 dark:text-gray-900 dark:hover:bg-white font-semibold px-4 py-2">Agregar platillo</button>
                        </div>
                        <p class="mb-3 text-xs text-gray-500 dark:text-gray-400">Todos los platillos deben tener nombre y precio para guardar borrador.</p>
                        <div data-list="menuItems" class="space-y-4"></div>
                    </section>
                @endif

                @if($section === 'theme.settings')
                    <section class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5 space-y-4">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <h3 class="text-xl font-bold">Estilo global del sitio</h3>
                            <button type="button" id="themeResetDefaultsButton" class="inline-flex items-center rounded-full bg-gray-800 hover:bg-black text-white font-semibold px-4 py-2">Restaurar por defecto</button>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Define colores y tipografias para Home, Menu, Acerca, Vacantes y Aviso de Privacidad.</p>

                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4 space-y-3">
                            <p class="text-xs uppercase tracking-[0.16em] text-gray-500">Paletas recomendadas</p>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" data-theme-preset="clasico" class="inline-flex items-center rounded-full bg-gray-900 hover:bg-black text-white text-xs font-semibold px-3 py-1.5">Clasico</button>
                                <button type="button" data-theme-preset="alto_contraste" class="inline-flex items-center rounded-full bg-gray-900 hover:bg-black text-white text-xs font-semibold px-3 py-1.5">Alto contraste</button>
                                <button type="button" data-theme-preset="calido" class="inline-flex items-center rounded-full bg-gray-900 hover:bg-black text-white text-xs font-semibold px-3 py-1.5">Calido</button>
                                <button type="button" data-theme-preset="fresco" class="inline-flex items-center rounded-full bg-gray-900 hover:bg-black text-white text-xs font-semibold px-3 py-1.5">Fresco</button>
                            </div>
                        </div>

                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4 space-y-3">
                            <p class="text-xs uppercase tracking-[0.16em] text-gray-500">Tus paletas guardadas</p>
                            <form id="themeSavePresetForm" method="POST" action="{{ route('panel.content.theme.presets.save') }}" class="flex flex-wrap items-end gap-2">
                                @csrf
                                <div class="min-w-[220px] flex-1">
                                    <label for="theme_preset_name" class="block text-xs font-semibold mb-1">Nombre del preset</label>
                                    <input id="theme_preset_name" name="preset_name" type="text" maxlength="80" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2" placeholder="Ej. Campana Verano 2026">
                                </div>
                                <input type="hidden" id="theme_preset_payload_json" name="preset_payload_json" value="{}">
                                <button type="submit" class="inline-flex items-center rounded-full bg-gray-900 hover:bg-black text-white text-sm font-semibold px-4 py-2">Guardar preset</button>
                            </form>

                            @if(!empty($themePresets ?? []))
                                <div class="flex flex-wrap gap-2 pt-2">
                                    @foreach(($themePresets ?? []) as $preset)
                                        <button
                                            type="button"
                                            class="inline-flex items-center rounded-full bg-white dark:bg-gray-950 border border-gray-300 dark:border-gray-700 text-xs font-semibold px-3 py-1.5"
                                            data-theme-preset-custom='@json($preset['payload'])'
                                        >{{ $preset['name'] }}</button>
                                        <form method="POST" action="{{ route('panel.content.theme.presets.delete', ['slug' => $preset['slug']]) }}" class="inline-block">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center rounded-full bg-red-50 border border-red-200 text-red-700 text-xs font-semibold px-3 py-1.5">Eliminar</button>
                                        </form>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xs text-gray-500 dark:text-gray-400">Aun no tienes presets personalizados guardados.</p>
                            @endif
                        </div>

                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4 space-y-3">
                            <p class="text-xs uppercase tracking-[0.16em] text-gray-500">Publicacion programada</p>
                            <form method="POST" action="{{ route('panel.content.theme.schedule') }}" class="grid md:grid-cols-3 gap-3 items-end">
                                @csrf
                                <div class="md:col-span-2">
                                    <label for="theme_publish_at" class="block text-xs font-semibold mb-1">Fecha y hora de publicacion</label>
                                    <input id="theme_publish_at" name="publish_at" type="datetime-local" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2" required>
                                </div>
                                <button type="submit" class="inline-flex items-center justify-center rounded-full bg-yellow-500 hover:bg-yellow-600 text-gray-900 text-sm font-semibold px-4 py-2">Programar</button>
                            </form>
                            @if($scheduledPublishAt)
                                <div class="flex flex-wrap items-center justify-between gap-2 rounded-lg bg-amber-50 border border-amber-200 px-3 py-2 text-sm text-amber-800">
                                    <p>Programado para: <strong>{{ $scheduledPublishAt->format('d/m/Y H:i') }}</strong></p>
                                    <form method="POST" action="{{ route('panel.content.theme.schedule.cancel') }}">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center rounded-full bg-white border border-amber-300 px-3 py-1 text-xs font-semibold">Cancelar programacion</button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1" for="theme_primary_color">Color principal</label>
                                <div class="flex items-center gap-2">
                                    <input id="theme_primary_color" type="color" class="h-11 w-14 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-1 py-1">
                                    <input id="theme_primary_color_text" type="text" class="flex-1 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2" placeholder="#DC2626">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1" for="theme_accent_color">Color acento</label>
                                <div class="flex items-center gap-2">
                                    <input id="theme_accent_color" type="color" class="h-11 w-14 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-1 py-1">
                                    <input id="theme_accent_color_text" type="text" class="flex-1 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2" placeholder="#FACC15">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1" for="theme_background_color">Color background (sitio)</label>
                                <div class="flex items-center gap-2">
                                    <input id="theme_background_color" type="color" class="h-11 w-14 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-1 py-1">
                                    <input id="theme_background_color_text" type="text" class="flex-1 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2" placeholder="#FFFAF5">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1" for="theme_text_color">Color de texto</label>
                                <div class="flex items-center gap-2">
                                    <input id="theme_text_color" type="color" class="h-11 w-14 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-1 py-1">
                                    <input id="theme_text_color_text" type="text" class="flex-1 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2" placeholder="#1F2937">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1" for="theme_card_color">Color de tarjetas</label>
                                <div class="flex items-center gap-2">
                                    <input id="theme_card_color" type="color" class="h-11 w-14 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-1 py-1">
                                    <input id="theme_card_color_text" type="text" class="flex-1 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2" placeholder="#FFF7EC">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1" for="theme_muted_text_color">Texto secundario</label>
                                <div class="flex items-center gap-2">
                                    <input id="theme_muted_text_color" type="color" class="h-11 w-14 rounded border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-1 py-1">
                                    <input id="theme_muted_text_color_text" type="text" class="flex-1 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2" placeholder="#4B5563">
                                </div>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1" for="theme_heading_font">Tipografia de encabezados</label>
                                <select id="theme_heading_font" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                    <option value="Poppins">Poppins</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Playfair Display">Playfair Display</option>
                                    <option value="Merriweather">Merriweather</option>
                                    <option value="Oswald">Oswald</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1" for="theme_body_font">Tipografia de texto</label>
                                <select id="theme_body_font" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                    <option value="Nunito Sans">Nunito Sans</option>
                                    <option value="Inter">Inter</option>
                                    <option value="Lato">Lato</option>
                                    <option value="Source Sans 3">Source Sans 3</option>
                                    <option value="Open Sans">Open Sans</option>
                                </select>
                            </div>
                        </div>

                        <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4">
                            <p class="text-xs uppercase tracking-[0.16em] text-gray-500 mb-2">Vista previa rapida</p>
                            <div id="themePreview" class="rounded-xl border border-gray-200 dark:border-gray-700 p-4">
                                <h4 id="themePreviewTitle" class="text-xl font-bold">Pollo Feliz Durango</h4>
                                <p id="themePreviewText" class="mt-2 text-sm">Asi se vera el estilo general en tu sitio publico.</p>
                                <button type="button" id="themePreviewButton" class="mt-3 rounded-full px-4 py-2 text-sm font-semibold text-white">Boton principal</button>
                            </div>
                        </div>

                        <div id="themeContrastAudit" class="rounded-xl border border-gray-200 dark:border-gray-700 p-4 space-y-2">
                            <p class="text-xs uppercase tracking-[0.16em] text-gray-500">Auditoria de contraste</p>
                            <p id="themeContrastTextResult" class="text-sm"></p>
                            <p id="themeContrastButtonResult" class="text-sm"></p>
                            <p id="themeContrastMutedResult" class="text-sm"></p>
                            <p id="themeContrastAdvice" class="text-xs text-gray-600 dark:text-gray-300"></p>
                        </div>
                    </section>
                @endif

                <details class="rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5">
                    <summary class="cursor-pointer font-semibold">Modo avanzado (JSON)</summary>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 mb-2">Se genera automaticamente desde el formulario visual.</p>
                    <textarea id="payload_json_preview" rows="18" class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-4 py-3 font-mono text-sm"></textarea>
                </details>
            </div>
        @else
            <div>
                <label for="payload_json" class="block text-sm font-semibold mb-2">Contenido JSON</label>
                <textarea id="payload_json" name="payload_json" rows="22" class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-4 py-3 font-mono text-sm">{{ old('payload_json', $payloadJson) }}</textarea>
            </div>
        @endif

        <div>
            <label for="change_note" class="block text-sm font-semibold mb-2">Nota de cambio (opcional)</label>
            <input id="change_note" name="change_note" type="text" value="{{ old('change_note') }}" class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-4 py-3" maxlength="255">
        </div>

        <div class="flex flex-wrap gap-3">
            <button type="submit" class="panel-btn">Guardar borrador</button>
            @if($section === 'theme.settings')
                <button type="button" id="compareThemeButton" class="panel-btn-muted">Comparar antes/despues</button>
            @endif
        </div>
    </form>

    <form method="POST" action="{{ match($section) {
        'home.content' => route('panel.content.home.publish'),
        'about.content' => route('panel.content.about.publish'),
        'footer.copy' => route('panel.content.footer.publish'),
        'menu.items' => route('panel.content.menu.publish'),
        'theme.settings' => route('panel.content.theme.publish'),
        default => '#'
    } }}" class="mt-6 panel-card p-5">
        @csrf
        <p class="font-semibold mb-2">Publicar ultimo borrador</p>
        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Esto reemplaza la version publicada y limpia cache de secciones relacionadas.</p>
        <label for="publish_change_note" class="block text-sm font-semibold mb-2">Nota de publicacion (opcional)</label>
        <input id="publish_change_note" name="change_note" type="text" class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-4 py-3" maxlength="255">
        <div class="mt-4 flex flex-wrap gap-3">
            <button type="button" id="previewPayloadButton" class="panel-btn-muted">Vista previa</button>
            <button type="submit" class="panel-btn">Publicar</button>
        </div>
    </form>

    <form method="POST" action="{{ match($section) {
        'home.content' => route('panel.content.home.revert'),
        'about.content' => route('panel.content.about.revert'),
        'footer.copy' => route('panel.content.footer.revert'),
        'menu.items' => route('panel.content.menu.revert'),
        'theme.settings' => route('panel.content.theme.revert'),
        default => '#'
    } }}" class="mt-4 panel-card p-5">
        @csrf
        <p class="font-semibold mb-2">Revertir borrador a ultima publicacion</p>
        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Restaura el borrador usando la ultima version publicada de esta seccion.</p>
        <label for="revert_change_note" class="block text-sm font-semibold mb-2">Nota de restauracion (opcional)</label>
        <input id="revert_change_note" name="change_note" type="text" class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-4 py-3" maxlength="255">
        <button type="submit" onclick="return confirm('Se reemplazara el borrador actual con la ultima version publicada. ¿Deseas continuar?')" class="mt-4 panel-btn-muted">Revertir borrador</button>
    </form>

    <section class="mt-6 rounded-2xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-5">
        <h3 class="text-lg font-bold">Historial de cambios</h3>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Ultimas modificaciones guardadas/publicadas para esta seccion.</p>

        @if(($revisions ?? collect())->isEmpty())
            <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">Aun no hay revisiones registradas.</p>
        @else
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left border-b border-gray-200 dark:border-gray-800">
                            <th class="py-2 pr-4 font-semibold">Fecha</th>
                            <th class="py-2 pr-4 font-semibold">Usuario</th>
                            <th class="py-2 pr-4 font-semibold">Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($revisions as $revision)
                            <tr class="border-b border-gray-100 dark:border-gray-800/70">
                                <td class="py-2 pr-4 text-gray-700 dark:text-gray-300">{{ optional($revision['created_at'])->format('d/m/Y H:i') ?? '-' }}</td>
                                <td class="py-2 pr-4 text-gray-700 dark:text-gray-300">{{ $revision['changed_by_name'] ?? $revision['changed_by_email'] ?? 'Sistema' }}</td>
                                <td class="py-2 pr-4 text-gray-700 dark:text-gray-300">{{ $revision['change_note'] !== '' ? $revision['change_note'] : 'Sin nota' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    <div id="payloadPreviewModal" class="fixed inset-0 z-[1000] hidden items-center justify-center bg-black/70 p-4">
        <div class="w-full max-w-4xl rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-2xl">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-800">
                <h4 class="text-lg font-bold">Vista previa antes de publicar</h4>
                <button type="button" id="closePayloadPreviewModal" class="rounded-full w-9 h-9 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 font-bold">×</button>
            </div>
            <div class="p-5">
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">Revisa el JSON que se publicara para evitar cambios accidentales.</p>
                <pre id="payloadPreviewContent" class="max-h-[60vh] overflow-auto rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-950 p-4 text-xs"></pre>
            </div>
        </div>
    </div>

    <div id="themeCompareModal" class="fixed inset-0 z-[1000] hidden items-center justify-center bg-black/70 p-4">
        <div class="w-full max-w-5xl rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-2xl">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-200 dark:border-gray-800">
                <h4 class="text-lg font-bold">Comparar antes y despues</h4>
                <button type="button" id="closeThemeCompareModal" class="rounded-full w-9 h-9 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 font-bold">×</button>
            </div>
            <div class="p-5 grid md:grid-cols-2 gap-4">
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4">
                    <p class="text-xs uppercase tracking-[0.16em] text-gray-500 mb-2">Antes (publicado)</p>
                    <div id="themeCompareBefore" class="rounded-xl border p-4">
                        <h5 class="text-lg font-bold">Pollo Feliz Durango</h5>
                        <p class="mt-2 text-sm">Vista actual del tema publicado.</p>
                        <button type="button" class="mt-3 rounded-full px-4 py-2 text-sm font-semibold text-white">Boton</button>
                    </div>
                </div>
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4">
                    <p class="text-xs uppercase tracking-[0.16em] text-gray-500 mb-2">Despues (borrador)</p>
                    <div id="themeCompareAfter" class="rounded-xl border p-4">
                        <h5 class="text-lg font-bold">Pollo Feliz Durango</h5>
                        <p class="mt-2 text-sm">Vista con cambios sin publicar.</p>
                        <button type="button" class="mt-3 rounded-full px-4 py-2 text-sm font-semibold text-white">Boton</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($isVisualSection)
        <script>
            (() => {
                const editorRoot = document.getElementById('visualContentEditor');
                const payloadInput = document.getElementById('payload_json');
                const payloadPreview = document.getElementById('payload_json_preview');

                if (!editorRoot || !payloadInput) {
                    return;
                }

                const section = editorRoot.dataset.section || '';
                const csrf = editorRoot.dataset.csrf || '';
                const uploadUrl = editorRoot.dataset.uploadUrl || '';
                const initial = JSON.parse(editorRoot.dataset.initial || '{}');
                const themeDefaults = JSON.parse(editorRoot.dataset.themeDefaults || '{}');
                const draftForm = document.getElementById('draftContentForm');
                const previewButton = document.getElementById('previewPayloadButton');
                const previewModal = document.getElementById('payloadPreviewModal');
                const previewContent = document.getElementById('payloadPreviewContent');
                const closePreviewButton = document.getElementById('closePayloadPreviewModal');
                const unsavedNotice = document.getElementById('unsavedChangesNotice');
                const resetThemeDefaultsButton = document.getElementById('themeResetDefaultsButton');
                const savePresetForm = document.getElementById('themeSavePresetForm');
                const savePresetPayloadInput = document.getElementById('theme_preset_payload_json');
                const compareThemeButton = document.getElementById('compareThemeButton');
                const themeCompareModal = document.getElementById('themeCompareModal');
                const closeThemeCompareModal = document.getElementById('closeThemeCompareModal');
                const initialSerialized = payloadInput.value;
                let isSubmittingForm = false;
                function escapeHtml(value) {
                    return String(value)
                        .replaceAll('&', '&amp;')
                        .replaceAll('<', '&lt;')
                        .replaceAll('>', '&gt;')
                        .replaceAll('"', '&quot;');
                }

                function toPlainText(value) {
                    return typeof value === 'string' ? value : '';
                }

                function normalizeRating(value) {
                    const parsed = Number(value);
                    if (!Number.isFinite(parsed)) {
                        return 5;
                    }

                    return Math.max(1, Math.min(5, Math.round(parsed)));
                }

                function resolveImageUrl(path) {
                    if (!path) {
                        return '';
                    }

                    if (/^https?:\/\//i.test(path)) {
                        return path;
                    }

                    return '/' + String(path).replace(/^\/+/, '');
                }

                async function uploadImage(file) {
                    if (!uploadUrl || !file) {
                        throw new Error('No fue posible preparar la subida de imagen.');
                    }

                    const formData = new FormData();
                    formData.append('image', file);

                    const response = await fetch(uploadUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    const data = await response.json().catch(() => ({}));
                    if (!response.ok || !data.path) {
                        throw new Error(data.message || 'No se pudo subir la imagen.');
                    }

                    return data.path;
                }

                function bindSingleUpload(targetId, onChange) {
                    const input = document.getElementById(targetId);
                    const button = editorRoot.querySelector(`[data-upload-target-id="${targetId}"]`);
                    const fileInput = editorRoot.querySelector(`[data-upload-for="${targetId}"]`);
                    const preview = document.getElementById(`${targetId}_preview`);

                    if (!input || !button || !fileInput) {
                        return;
                    }

                    const syncPreview = () => {
                        if (!preview) {
                            return;
                        }

                        const value = input.value.trim();
                        if (!value) {
                            preview.classList.add('hidden');
                            preview.removeAttribute('src');
                            return;
                        }

                        preview.src = resolveImageUrl(value);
                        preview.classList.remove('hidden');
                    };

                    input.addEventListener('input', () => {
                        syncPreview();
                        onChange();
                    });

                    button.addEventListener('click', () => {
                        fileInput.click();
                    });

                    fileInput.addEventListener('change', async () => {
                        const file = fileInput.files && fileInput.files[0] ? fileInput.files[0] : null;
                        if (!file) {
                            return;
                        }

                        const originalText = button.textContent;
                        button.textContent = 'Subiendo...';
                        button.disabled = true;

                        try {
                            const path = await uploadImage(file);
                            input.value = path;
                            syncPreview();
                            onChange();
                        } catch (error) {
                            alert(error instanceof Error ? error.message : 'Error al subir imagen.');
                        } finally {
                            fileInput.value = '';
                            button.textContent = originalText;
                            button.disabled = false;
                        }
                    });

                    syncPreview();
                }

                const state = {
                    hero: [],
                    promotions: [],
                    testimonials: [],
                    aboutParagraphs: [],
                    timeline: [],
                    values: [],
                    menuItems: [],
                };

                const templates = {
                    hero: (item, index) => `
                        <article class="rounded-xl border border-gray-200 dark:border-gray-700 p-4" data-item-type="hero" data-index="${index}">
                            <div class="grid md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Imagen (ruta)</label>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <input data-field="image" type="text" value="${escapeHtml(item.image ?? '')}" class="flex-1 min-w-[180px] rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                        <button type="button" data-upload-item="hero" data-field="image" data-index="${index}" class="inline-flex items-center rounded-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2">Subir imagen</button>
                                        <input data-upload-item-file="hero" data-index="${index}" data-field="image" type="file" accept="image/*" class="hidden">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Titulo</label>
                                    <input data-field="title" type="text" value="${escapeHtml(item.title ?? '')}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-semibold mb-1">Texto</label>
                                <textarea data-field="text" rows="3" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">${escapeHtml(item.text ?? '')}</textarea>
                            </div>
                            <div class="mt-3 text-right">
                                <button type="button" data-remove="hero" data-index="${index}" class="text-sm text-red-600 hover:text-red-700 font-semibold">Eliminar slide</button>
                            </div>
                        </article>
                    `,
                    promotions: (item, index) => `
                        <article class="rounded-xl border border-gray-200 dark:border-gray-700 p-4" data-item-type="promotions" data-index="${index}">
                            <div class="grid md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Titulo</label>
                                    <input data-field="title" type="text" value="${escapeHtml(item.title ?? '')}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Precio</label>
                                    <input data-field="price" type="text" value="${escapeHtml(item.price ?? '')}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-semibold mb-1">Descripcion</label>
                                <textarea data-field="description" rows="3" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">${escapeHtml(item.description ?? '')}</textarea>
                            </div>
                            <div class="mt-3 text-right">
                                <button type="button" data-remove="promotions" data-index="${index}" class="text-sm text-red-600 hover:text-red-700 font-semibold">Eliminar promocion</button>
                            </div>
                        </article>
                    `,
                    testimonials: (item, index) => `
                        <article class="rounded-xl border border-gray-200 dark:border-gray-700 p-4" data-item-type="testimonials" data-index="${index}">
                            <div class="grid md:grid-cols-3 gap-3">
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Nombre</label>
                                    <input data-field="name" type="text" value="${escapeHtml(item.name ?? '')}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Zona</label>
                                    <input data-field="zone" type="text" value="${escapeHtml(item.zone ?? '')}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Calificacion (1-5)</label>
                                    <input data-field="rating" min="1" max="5" type="number" value="${escapeHtml(String(item.rating ?? 5))}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-semibold mb-1">Resena</label>
                                <textarea data-field="quote" rows="3" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">${escapeHtml(item.quote ?? '')}</textarea>
                            </div>
                            <div class="mt-3 text-right">
                                <button type="button" data-remove="testimonials" data-index="${index}" class="text-sm text-red-600 hover:text-red-700 font-semibold">Eliminar testimonio</button>
                            </div>
                        </article>
                    `,
                    aboutParagraphs: (item, index) => `
                        <article class="rounded-xl border border-gray-200 dark:border-gray-700 p-3" data-item-type="aboutParagraphs" data-index="${index}">
                            <label class="block text-sm font-semibold mb-1">Parrafo ${index + 1}</label>
                            <textarea data-field="value" rows="3" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">${escapeHtml(item)}</textarea>
                            <div class="mt-2 text-right">
                                <button type="button" data-remove="aboutParagraphs" data-index="${index}" class="text-sm text-red-600 hover:text-red-700 font-semibold">Eliminar parrafo</button>
                            </div>
                        </article>
                    `,
                    timeline: (item, index) => `
                        <article class="rounded-xl border border-gray-200 dark:border-gray-700 p-4" data-item-type="timeline" data-index="${index}">
                            <div class="grid md:grid-cols-3 gap-3">
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Anio</label>
                                    <input data-field="year" type="text" value="${escapeHtml(item.year ?? '')}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold mb-1">Titulo</label>
                                    <input data-field="title" type="text" value="${escapeHtml(item.title ?? '')}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-semibold mb-1">Descripcion</label>
                                <textarea data-field="description" rows="3" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">${escapeHtml(item.description ?? '')}</textarea>
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-semibold mb-1">Imagen (ruta)</label>
                                <div class="flex flex-wrap items-center gap-2">
                                    <input data-field="image" type="text" value="${escapeHtml(item.image ?? '')}" class="flex-1 min-w-[180px] rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                    <button type="button" data-upload-item="timeline" data-field="image" data-index="${index}" class="inline-flex items-center rounded-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2">Subir imagen</button>
                                    <input data-upload-item-file="timeline" data-index="${index}" data-field="image" type="file" accept="image/*" class="hidden">
                                </div>
                            </div>
                            <div class="mt-3 text-right">
                                <button type="button" data-remove="timeline" data-index="${index}" class="text-sm text-red-600 hover:text-red-700 font-semibold">Eliminar hito</button>
                            </div>
                        </article>
                    `,
                    values: (item, index) => `
                        <article class="rounded-xl border border-gray-200 dark:border-gray-700 p-4" data-item-type="values" data-index="${index}">
                            <div class="grid md:grid-cols-3 gap-3">
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Icono</label>
                                    <input data-field="icon" type="text" value="${escapeHtml(item.icon ?? '')}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold mb-1">Titulo</label>
                                    <input data-field="title" type="text" value="${escapeHtml(item.title ?? '')}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-semibold mb-1">Descripcion</label>
                                <textarea data-field="description" rows="3" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">${escapeHtml(item.description ?? '')}</textarea>
                            </div>
                            <div class="mt-3 text-right">
                                <button type="button" data-remove="values" data-index="${index}" class="text-sm text-red-600 hover:text-red-700 font-semibold">Eliminar valor</button>
                            </div>
                        </article>
                    `,
                    menuItems: (item, index) => `
                        <article class="rounded-xl border border-gray-200 dark:border-gray-700 p-4" data-item-type="menuItems" data-index="${index}">
                            <div class="grid md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Platillo</label>
                                    <input data-field="name" type="text" value="${escapeHtml(item.name ?? '')}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-1">Precio</label>
                                    <input data-field="price" type="text" value="${escapeHtml(item.price ?? '')}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 px-3 py-2">
                                </div>
                            </div>
                            <div class="mt-3 text-right">
                                <button type="button" data-remove="menuItems" data-index="${index}" class="text-sm text-red-600 hover:text-red-700 font-semibold">Eliminar platillo</button>
                            </div>
                        </article>
                    `,
                };

                const emptyItem = {
                    hero: { image: '', title: '', text: '' },
                    promotions: { title: '', description: '', price: '' },
                    testimonials: { name: '', zone: '', quote: '', rating: 5 },
                    aboutParagraphs: '',
                    timeline: { year: '', title: '', description: '', image: '' },
                    values: { icon: '', title: '', description: '' },
                    menuItems: { name: '', price: '' },
                };

                const ensureOneItem = (list, fallback) => {
                    if (!Array.isArray(list) || list.length) {
                        return;
                    }

                    if (typeof fallback === 'object') {
                        list.push({ ...fallback });
                        return;
                    }

                    list.push(fallback);
                };

                function updateAboutStaticFields() {
                    if (section !== 'about.content') {
                        return;
                    }

                    const summary = initial.summary && typeof initial.summary === 'object' ? initial.summary : {};
                    const images = initial.images && typeof initial.images === 'object' ? initial.images : {};

                    const setValue = (id, value) => {
                        const element = document.getElementById(id);
                        if (element) {
                            element.value = toPlainText(value);
                        }
                    };

                    setValue('about_summary_label', summary.label);
                    setValue('about_summary_title', summary.title);
                    setValue('about_summary_button', summary.button);
                    setValue('about_summary_image', summary.image);
                    setValue('about_image_hero', images.hero);
                    setValue('about_image_history', images.history);
                    setValue('about_image_mission', images.mission);
                    setValue('about_image_vision', images.vision);

                    [
                        'about_summary_image',
                        'about_image_hero',
                        'about_image_history',
                        'about_image_mission',
                        'about_image_vision',
                    ].forEach((id) => bindSingleUpload(id, syncPayloadInput));

                    [
                        'about_summary_label',
                        'about_summary_title',
                        'about_summary_button',
                        'about_summary_image',
                        'about_image_hero',
                        'about_image_history',
                        'about_image_mission',
                        'about_image_vision',
                    ].forEach((id) => {
                        const element = document.getElementById(id);
                        if (element) {
                            element.addEventListener('input', syncPayloadInput);
                        }
                    });
                }

                function updateFooterFields() {
                    if (section !== 'footer.copy') {
                        return;
                    }

                    const setValue = (id, value) => {
                        const element = document.getElementById(id);
                        if (element) {
                            element.value = toPlainText(value);
                            element.addEventListener('input', syncPayloadInput);
                        }
                    };

                    setValue('footer_cta_label', initial.cta_label);
                    setValue('footer_cta_title', initial.cta_title);
                    setValue('footer_brand_description', initial.brand_description);
                }

                function updateThemeFields() {
                    if (section !== 'theme.settings') {
                        return;
                    }

                    const themePresets = {
                        clasico: {
                            primary_color: '#DC2626',
                            accent_color: '#FACC15',
                            background_color: '#FFFAF5',
                            card_color: '#FFF7EC',
                            text_color: '#1F2937',
                            muted_text_color: '#4B5563',
                            heading_font: 'Poppins',
                            body_font: 'Nunito Sans',
                        },
                        alto_contraste: {
                            primary_color: '#111827',
                            accent_color: '#F59E0B',
                            background_color: '#FFFFFF',
                            card_color: '#F3F4F6',
                            text_color: '#111827',
                            muted_text_color: '#374151',
                            heading_font: 'Montserrat',
                            body_font: 'Inter',
                        },
                        calido: {
                            primary_color: '#B45309',
                            accent_color: '#F59E0B',
                            background_color: '#FFFBEB',
                            card_color: '#FEF3C7',
                            text_color: '#3F2A14',
                            muted_text_color: '#6B4F2A',
                            heading_font: 'Merriweather',
                            body_font: 'Lato',
                        },
                        fresco: {
                            primary_color: '#0F766E',
                            accent_color: '#22C55E',
                            background_color: '#F0FDFA',
                            card_color: '#CCFBF1',
                            text_color: '#134E4A',
                            muted_text_color: '#0F766E',
                            heading_font: 'Oswald',
                            body_font: 'Source Sans 3',
                        },
                    };

                    const applyThemePreset = (preset) => {
                        const applyValue = (colorId, textId, value, fallback) => {
                            const colorInput = document.getElementById(colorId);
                            const textInput = document.getElementById(textId);
                            const normalized = /^#[0-9A-Fa-f]{6}$/.test(String(value)) ? String(value).toUpperCase() : fallback;

                            if (colorInput) {
                                colorInput.value = normalized;
                            }

                            if (textInput) {
                                textInput.value = normalized;
                            }
                        };

                        applyValue('theme_primary_color', 'theme_primary_color_text', preset.primary_color, '#DC2626');
                        applyValue('theme_accent_color', 'theme_accent_color_text', preset.accent_color, '#FACC15');
                        applyValue('theme_background_color', 'theme_background_color_text', preset.background_color, '#FFFAF5');
                        applyValue('theme_card_color', 'theme_card_color_text', preset.card_color, '#FFF7EC');
                        applyValue('theme_text_color', 'theme_text_color_text', preset.text_color, '#1F2937');
                        applyValue('theme_muted_text_color', 'theme_muted_text_color_text', preset.muted_text_color, '#4B5563');

                        const headingFont = document.getElementById('theme_heading_font');
                        const bodyFont = document.getElementById('theme_body_font');

                        if (headingFont && preset.heading_font) {
                            headingFont.value = String(preset.heading_font);
                        }

                        if (bodyFont && preset.body_font) {
                            bodyFont.value = String(preset.body_font);
                        }

                        syncThemePreview();
                        syncPayloadInput();
                    };

                    const syncPair = (colorId, textId, initialValue) => {
                        const colorInput = document.getElementById(colorId);
                        const textInput = document.getElementById(textId);
                        const fallback = '#000000';
                        const normalized = /^#[0-9A-Fa-f]{6}$/.test(String(initialValue)) ? String(initialValue).toUpperCase() : fallback;

                        if (!colorInput || !textInput) {
                            return;
                        }

                        colorInput.value = normalized;
                        textInput.value = normalized;

                        colorInput.addEventListener('input', () => {
                            textInput.value = colorInput.value.toUpperCase();
                            syncThemePreview();
                            syncPayloadInput();
                        });

                        textInput.addEventListener('input', () => {
                            const maybe = textInput.value.trim();
                            if (/^#[0-9A-Fa-f]{6}$/.test(maybe)) {
                                colorInput.value = maybe;
                            }

                            syncThemePreview();
                            syncPayloadInput();
                        });
                    };

                    syncPair('theme_primary_color', 'theme_primary_color_text', initial.primary_color ?? '#DC2626');
                    syncPair('theme_accent_color', 'theme_accent_color_text', initial.accent_color ?? '#FACC15');
                    syncPair('theme_background_color', 'theme_background_color_text', initial.background_color ?? initial.surface_color ?? '#FFFAF5');
                    syncPair('theme_card_color', 'theme_card_color_text', initial.card_color ?? '#FFF7EC');
                    syncPair('theme_text_color', 'theme_text_color_text', initial.text_color ?? '#1F2937');
                    syncPair('theme_muted_text_color', 'theme_muted_text_color_text', initial.muted_text_color ?? '#4B5563');

                    const headingFont = document.getElementById('theme_heading_font');
                    const bodyFont = document.getElementById('theme_body_font');

                    if (headingFont) {
                        headingFont.value = String(initial.heading_font ?? 'Poppins');
                        headingFont.addEventListener('change', () => {
                            syncThemePreview();
                            syncPayloadInput();
                        });
                    }

                    if (bodyFont) {
                        bodyFont.value = String(initial.body_font ?? 'Nunito Sans');
                        bodyFont.addEventListener('change', () => {
                            syncThemePreview();
                            syncPayloadInput();
                        });
                    }

                    if (resetThemeDefaultsButton) {
                        resetThemeDefaultsButton.addEventListener('click', () => {
                            applyThemePreset({
                                primary_color: themeDefaults.primary_color ?? '#DC2626',
                                accent_color: themeDefaults.accent_color ?? '#FACC15',
                                background_color: themeDefaults.background_color ?? themeDefaults.surface_color ?? '#FFFAF5',
                                card_color: themeDefaults.card_color ?? '#FFF7EC',
                                text_color: themeDefaults.text_color ?? '#1F2937',
                                muted_text_color: themeDefaults.muted_text_color ?? '#4B5563',
                                heading_font: themeDefaults.heading_font ?? 'Poppins',
                                body_font: themeDefaults.body_font ?? 'Nunito Sans',
                            });
                        });
                    }

                    Array.from(editorRoot.querySelectorAll('[data-theme-preset]')).forEach((button) => {
                        button.addEventListener('click', () => {
                            const key = button.getAttribute('data-theme-preset') || '';
                            const preset = themePresets[key];
                            if (!preset) {
                                return;
                            }

                            applyThemePreset(preset);
                        });
                    });

                    Array.from(editorRoot.querySelectorAll('[data-theme-preset-custom]')).forEach((button) => {
                        button.addEventListener('click', () => {
                            const raw = button.getAttribute('data-theme-preset-custom');
                            if (!raw) {
                                return;
                            }

                            try {
                                const parsed = JSON.parse(raw);
                                if (parsed && typeof parsed === 'object') {
                                    applyThemePreset(parsed);
                                }
                            } catch (_error) {
                                // Ignore malformed custom preset payload.
                            }
                        });
                    });

                    syncThemePreview();
                }

                function hexToRgb(hex) {
                    const normalized = String(hex).replace('#', '');
                    if (!/^[0-9A-Fa-f]{6}$/.test(normalized)) {
                        return null;
                    }

                    return {
                        r: parseInt(normalized.slice(0, 2), 16),
                        g: parseInt(normalized.slice(2, 4), 16),
                        b: parseInt(normalized.slice(4, 6), 16),
                    };
                }

                function luminanceFromRgb(rgb) {
                    const convert = (value) => {
                        const channel = value / 255;
                        return channel <= 0.03928 ? channel / 12.92 : ((channel + 0.055) / 1.055) ** 2.4;
                    };

                    const red = convert(rgb.r);
                    const green = convert(rgb.g);
                    const blue = convert(rgb.b);
                    return 0.2126 * red + 0.7152 * green + 0.0722 * blue;
                }

                function contrastRatio(firstHex, secondHex) {
                    const firstRgb = hexToRgb(firstHex);
                    const secondRgb = hexToRgb(secondHex);

                    if (!firstRgb || !secondRgb) {
                        return null;
                    }

                    const firstLum = luminanceFromRgb(firstRgb);
                    const secondLum = luminanceFromRgb(secondRgb);
                    const lighter = Math.max(firstLum, secondLum);
                    const darker = Math.min(firstLum, secondLum);

                    return (lighter + 0.05) / (darker + 0.05);
                }

                function syncThemeContrastAudit(background, text, primary, mutedText) {
                    const textResult = document.getElementById('themeContrastTextResult');
                    const buttonResult = document.getElementById('themeContrastButtonResult');
                    const mutedResult = document.getElementById('themeContrastMutedResult');
                    const advice = document.getElementById('themeContrastAdvice');

                    if (!textResult || !buttonResult || !mutedResult || !advice) {
                        return;
                    }

                    const textContrast = contrastRatio(background, text);
                    const buttonContrast = contrastRatio(primary, '#FFFFFF');
                    const mutedContrast = contrastRatio(background, mutedText);

                    const renderResult = (ratio, threshold) => {
                        if (ratio === null) {
                            return { text: 'Color invalido', ok: false };
                        }

                        const ok = ratio >= threshold;
                        return {
                            text: `${ratio.toFixed(2)}:1 ${ok ? 'OK' : 'Bajo'}`,
                            ok,
                        };
                    };

                    const textInfo = renderResult(textContrast, 4.5);
                    const buttonInfo = renderResult(buttonContrast, 4.5);
                    const mutedInfo = renderResult(mutedContrast, 3);

                    textResult.textContent = `Texto sobre background: ${textInfo.text}`;
                    textResult.className = `text-sm ${textInfo.ok ? 'text-green-700 dark:text-green-400' : 'text-red-700 dark:text-red-400'}`;

                    buttonResult.textContent = `Boton principal (texto blanco): ${buttonInfo.text}`;
                    buttonResult.className = `text-sm ${buttonInfo.ok ? 'text-green-700 dark:text-green-400' : 'text-red-700 dark:text-red-400'}`;

                    mutedResult.textContent = `Texto secundario sobre background: ${mutedInfo.text}`;
                    mutedResult.className = `text-sm ${mutedInfo.ok ? 'text-green-700 dark:text-green-400' : 'text-red-700 dark:text-red-400'}`;

                    if (textInfo.ok && buttonInfo.ok && mutedInfo.ok) {
                        advice.textContent = 'Contraste recomendado para lectura normal cumplido.';
                    } else {
                        advice.textContent = 'Recomendacion: separa mas luminosidad entre colores (claro/oscuro) para mejorar legibilidad.';
                    }
                }

                function syncThemePreview() {
                    if (section !== 'theme.settings') {
                        return;
                    }

                    const get = (id, fallback = '') => {
                        const element = document.getElementById(id);
                        return element ? String(element.value || fallback) : fallback;
                    };

                    const primary = get('theme_primary_color_text', '#DC2626');
                    const background = get('theme_background_color_text', '#FFFAF5');
                    const card = get('theme_card_color_text', '#FFF7EC');
                    const text = get('theme_text_color_text', '#1F2937');
                    const mutedText = get('theme_muted_text_color_text', '#4B5563');
                    const headingFont = get('theme_heading_font', 'Poppins');
                    const bodyFont = get('theme_body_font', 'Nunito Sans');

                    const preview = document.getElementById('themePreview');
                    const previewTitle = document.getElementById('themePreviewTitle');
                    const previewText = document.getElementById('themePreviewText');
                    const previewButton = document.getElementById('themePreviewButton');

                    if (!preview || !previewTitle || !previewText || !previewButton) {
                        return;
                    }

                    preview.style.backgroundColor = card;
                    preview.style.color = text;
                    preview.style.borderColor = background;
                    previewTitle.style.fontFamily = `'${headingFont}', sans-serif`;
                    previewText.style.fontFamily = `'${bodyFont}', sans-serif`;
                    previewText.style.color = mutedText;
                    previewButton.style.backgroundColor = primary;
                    previewButton.style.fontFamily = `'${bodyFont}', sans-serif`;

                    syncThemeContrastAudit(background, text, primary, mutedText);
                }

                function renderThemeSnapshot(element, payload) {
                    if (!element || !payload || typeof payload !== 'object') {
                        return;
                    }

                    const background = String(payload.background_color ?? payload.surface_color ?? '#FFFAF5');
                    const card = String(payload.card_color ?? '#FFF7EC');
                    const text = String(payload.text_color ?? '#1F2937');
                    const mutedText = String(payload.muted_text_color ?? '#4B5563');
                    const primary = String(payload.primary_color ?? '#DC2626');
                    const headingFont = String(payload.heading_font ?? 'Poppins');
                    const bodyFont = String(payload.body_font ?? 'Nunito Sans');

                    const title = element.querySelector('h5');
                    const paragraph = element.querySelector('p');
                    const button = element.querySelector('button');

                    element.style.backgroundColor = card;
                    element.style.borderColor = background;
                    element.style.color = text;

                    if (title) {
                        title.style.fontFamily = `'${headingFont}', sans-serif`;
                        title.style.color = text;
                    }

                    if (paragraph) {
                        paragraph.style.fontFamily = `'${bodyFont}', sans-serif`;
                        paragraph.style.color = mutedText;
                    }

                    if (button) {
                        button.style.backgroundColor = primary;
                        button.style.color = '#FFFFFF';
                        button.style.fontFamily = `'${bodyFont}', sans-serif`;
                    }
                }

                function renderType(type) {
                    const list = editorRoot.querySelector(`[data-list="${type}"]`);
                    if (!list || !templates[type]) {
                        return;
                    }

                    list.innerHTML = state[type].map((item, index) => templates[type](item, index)).join('');

                    attachDragAndDrop(list, type);

                    Array.from(list.children).forEach((child, index) => {
                        Array.from(child.querySelectorAll('[data-field]')).forEach((input) => {
                            input.addEventListener('input', () => {
                                const field = input.dataset.field;
                                if (!field || !state[type][index]) {
                                    return;
                                }

                                if (type === 'aboutParagraphs') {
                                    state[type][index] = input.value;
                                } else if (field === 'rating') {
                                    state[type][index][field] = normalizeRating(input.value);
                                } else {
                                    state[type][index][field] = input.value;
                                }

                                syncPayloadInput();
                            });
                        });

                        const removeButton = child.querySelector('[data-remove]');
                        if (removeButton) {
                            removeButton.addEventListener('click', () => {
                                state[type].splice(index, 1);
                                ensureOneItem(state[type], emptyItem[type]);
                                render();
                            });
                        }

                        const uploadButton = child.querySelector('[data-upload-item]');
                        const uploadInput = child.querySelector('[data-upload-item-file]');

                        if (uploadButton && uploadInput) {
                            uploadButton.addEventListener('click', () => {
                                uploadInput.click();
                            });

                            uploadInput.addEventListener('change', async () => {
                                const file = uploadInput.files && uploadInput.files[0] ? uploadInput.files[0] : null;
                                if (!file) {
                                    return;
                                }

                                const originalText = uploadButton.textContent;
                                uploadButton.textContent = 'Subiendo...';
                                uploadButton.disabled = true;

                                try {
                                    const path = await uploadImage(file);
                                    const field = uploadButton.dataset.field;
                                    if (field && state[type][index]) {
                                        state[type][index][field] = path;
                                    }
                                    render();
                                } catch (error) {
                                    alert(error instanceof Error ? error.message : 'Error al subir imagen.');
                                } finally {
                                    uploadInput.value = '';
                                    uploadButton.textContent = originalText;
                                    uploadButton.disabled = false;
                                }
                            });
                        }
                    });
                }

                function moveItem(array, fromIndex, toIndex) {
                    if (!Array.isArray(array) || fromIndex === toIndex) {
                        return;
                    }

                    if (fromIndex < 0 || toIndex < 0 || fromIndex >= array.length || toIndex >= array.length) {
                        return;
                    }

                    const [moved] = array.splice(fromIndex, 1);
                    array.splice(toIndex, 0, moved);
                }

                function attachDragAndDrop(list, type) {
                    let dragIndex = null;

                    Array.from(list.children).forEach((card, index) => {
                        card.setAttribute('draggable', 'true');
                        card.classList.add('cursor-move');

                        card.addEventListener('dragstart', (event) => {
                            dragIndex = index;
                            card.classList.add('opacity-60');

                            if (event.dataTransfer) {
                                event.dataTransfer.effectAllowed = 'move';
                            }
                        });

                        card.addEventListener('dragend', () => {
                            dragIndex = null;
                            card.classList.remove('opacity-60');
                            Array.from(list.children).forEach((node) => node.classList.remove('ring-2', 'ring-yellow-400'));
                        });

                        card.addEventListener('dragover', (event) => {
                            event.preventDefault();
                            card.classList.add('ring-2', 'ring-yellow-400');
                        });

                        card.addEventListener('dragleave', () => {
                            card.classList.remove('ring-2', 'ring-yellow-400');
                        });

                        card.addEventListener('drop', (event) => {
                            event.preventDefault();
                            card.classList.remove('ring-2', 'ring-yellow-400');

                            if (dragIndex === null || dragIndex === index) {
                                return;
                            }

                            moveItem(state[type], dragIndex, index);
                            render();
                        });
                    });
                }

                function buildPayload() {
                    if (section === 'home.content') {
                        return {
                            hero_slides: state.hero,
                            promotions: state.promotions,
                            testimonials: state.testimonials,
                        };
                    }

                    if (section === 'about.content') {
                        const get = (id) => {
                            const element = document.getElementById(id);
                            return element ? element.value : '';
                        };

                        return {
                            summary: {
                                label: get('about_summary_label'),
                                title: get('about_summary_title'),
                                paragraphs: state.aboutParagraphs,
                                button: get('about_summary_button'),
                                image: get('about_summary_image'),
                            },
                            images: {
                                hero: get('about_image_hero'),
                                history: get('about_image_history'),
                                mission: get('about_image_mission'),
                                vision: get('about_image_vision'),
                            },
                            timeline: state.timeline,
                            values: state.values,
                        };
                    }

                    if (section === 'footer.copy') {
                        const get = (id) => {
                            const element = document.getElementById(id);
                            return element ? element.value : '';
                        };

                        return {
                            cta_label: get('footer_cta_label'),
                            cta_title: get('footer_cta_title'),
                            brand_description: get('footer_brand_description'),
                        };
                    }

                    if (section === 'menu.items') {
                        return {
                            items: state.menuItems,
                        };
                    }

                    if (section === 'theme.settings') {
                        const get = (id, fallback = '') => {
                            const element = document.getElementById(id);
                            return element ? String(element.value || fallback).trim() : fallback;
                        };

                        return {
                            primary_color: get('theme_primary_color_text', '#DC2626').toUpperCase(),
                            accent_color: get('theme_accent_color_text', '#FACC15').toUpperCase(),
                            background_color: get('theme_background_color_text', '#FFFAF5').toUpperCase(),
                            card_color: get('theme_card_color_text', '#FFF7EC').toUpperCase(),
                            text_color: get('theme_text_color_text', '#1F2937').toUpperCase(),
                            muted_text_color: get('theme_muted_text_color_text', '#4B5563').toUpperCase(),
                            heading_font: get('theme_heading_font', 'Poppins'),
                            body_font: get('theme_body_font', 'Nunito Sans'),
                        };
                    }

                    return {};
                }

                function syncPayloadInput() {
                    const payload = buildPayload();
                    const json = JSON.stringify(payload, null, 2);
                    payloadInput.value = json;

                    if (section === 'theme.settings' && savePresetPayloadInput) {
                        savePresetPayloadInput.value = json;
                    }

                    if (payloadPreview) {
                        payloadPreview.value = json;
                    }

                    updateUnsavedState();
                }

                function updateUnsavedState() {
                    if (!unsavedNotice) {
                        return;
                    }

                    const hasChanges = payloadInput.value !== initialSerialized;
                    unsavedNotice.classList.toggle('hidden', !hasChanges);
                }

                function render() {
                    if (section === 'home.content') {
                        renderType('hero');
                        renderType('promotions');
                        renderType('testimonials');
                    }

                    if (section === 'about.content') {
                        renderType('aboutParagraphs');
                        renderType('timeline');
                        renderType('values');
                    }

                    if (section === 'menu.items') {
                        renderType('menuItems');
                    }

                    syncPayloadInput();
                }

                Array.from(editorRoot.querySelectorAll('[data-add]')).forEach((button) => {
                    button.addEventListener('click', () => {
                        const type = button.dataset.add;
                        if (!type || !emptyItem[type]) {
                            return;
                        }

                        if (typeof emptyItem[type] === 'object') {
                            state[type].push({ ...emptyItem[type] });
                        } else {
                            state[type].push(emptyItem[type]);
                        }
                        render();
                    });
                });

                if (section === 'home.content') {
                    state.hero = Array.isArray(initial.hero_slides) ? initial.hero_slides : [];
                    state.promotions = Array.isArray(initial.promotions) ? initial.promotions : [];
                    state.testimonials = Array.isArray(initial.testimonials) ? initial.testimonials : [];
                    ensureOneItem(state.hero, emptyItem.hero);
                    ensureOneItem(state.promotions, emptyItem.promotions);
                    ensureOneItem(state.testimonials, emptyItem.testimonials);
                }

                if (section === 'about.content') {
                    const summary = initial.summary && typeof initial.summary === 'object' ? initial.summary : {};
                    state.aboutParagraphs = Array.isArray(summary.paragraphs) ? summary.paragraphs : [];
                    state.timeline = Array.isArray(initial.timeline) ? initial.timeline : [];
                    state.values = Array.isArray(initial.values) ? initial.values : [];

                    ensureOneItem(state.aboutParagraphs, emptyItem.aboutParagraphs);
                    ensureOneItem(state.timeline, emptyItem.timeline);
                    ensureOneItem(state.values, emptyItem.values);

                    updateAboutStaticFields();
                }

                if (section === 'footer.copy') {
                    updateFooterFields();
                }

                if (section === 'menu.items') {
                    state.menuItems = Array.isArray(initial.items) ? initial.items : [];
                    ensureOneItem(state.menuItems, emptyItem.menuItems);
                }

                if (section === 'theme.settings') {
                    updateThemeFields();
                }

                if (draftForm && section === 'menu.items') {
                    draftForm.addEventListener('submit', (event) => {
                        const invalidIndex = state.menuItems.findIndex((item) => {
                            const name = String(item?.name ?? '').trim();
                            const price = String(item?.price ?? '').trim();
                            return name === '' || price === '';
                        });

                        if (invalidIndex !== -1) {
                            event.preventDefault();
                            alert(`Completa nombre y precio en el platillo ${invalidIndex + 1} antes de guardar.`);
                            return;
                        }

                        isSubmittingForm = true;
                    });
                } else if (draftForm) {
                    draftForm.addEventListener('submit', () => {
                        isSubmittingForm = true;
                    });
                }

                window.addEventListener('beforeunload', (event) => {
                    if (isSubmittingForm) {
                        return;
                    }

                    if (payloadInput.value === initialSerialized) {
                        return;
                    }

                    event.preventDefault();
                    event.returnValue = '';
                });

                if (previewButton && previewModal && previewContent) {
                    const openPreview = () => {
                        const payload = payloadInput.value !== '' ? payloadInput.value : JSON.stringify(buildPayload(), null, 2);
                        previewContent.textContent = payload;
                        previewModal.classList.remove('hidden');
                        previewModal.classList.add('flex');
                    };

                    const closePreview = () => {
                        previewModal.classList.add('hidden');
                        previewModal.classList.remove('flex');
                    };

                    previewButton.addEventListener('click', openPreview);

                    if (closePreviewButton) {
                        closePreviewButton.addEventListener('click', closePreview);
                    }

                    previewModal.addEventListener('click', (event) => {
                        if (event.target === previewModal) {
                            closePreview();
                        }
                    });
                }

                if (section === 'theme.settings' && savePresetForm && savePresetPayloadInput) {
                    savePresetPayloadInput.value = payloadInput.value;

                    savePresetForm.addEventListener('submit', (event) => {
                        const nameInput = document.getElementById('theme_preset_name');
                        const name = nameInput ? String(nameInput.value || '').trim() : '';
                        if (name === '') {
                            event.preventDefault();
                            alert('Captura un nombre para el preset.');
                        }
                    });
                }

                if (section === 'theme.settings') {
                    const publishAtInput = document.getElementById('theme_publish_at');
                    if (publishAtInput && !publishAtInput.value) {
                        const now = new Date(Date.now() + 10 * 60 * 1000);
                        const yyyy = String(now.getFullYear());
                        const mm = String(now.getMonth() + 1).padStart(2, '0');
                        const dd = String(now.getDate()).padStart(2, '0');
                        const hh = String(now.getHours()).padStart(2, '0');
                        const min = String(now.getMinutes()).padStart(2, '0');
                        publishAtInput.value = `${yyyy}-${mm}-${dd}T${hh}:${min}`;
                    }
                }

                if (section === 'theme.settings' && compareThemeButton && themeCompareModal) {
                    const beforeNode = document.getElementById('themeCompareBefore');
                    const afterNode = document.getElementById('themeCompareAfter');

                    const openCompare = () => {
                        const draftPayload = buildPayload();
                        renderThemeSnapshot(beforeNode, initial);
                        renderThemeSnapshot(afterNode, draftPayload);
                        themeCompareModal.classList.remove('hidden');
                        themeCompareModal.classList.add('flex');
                    };

                    const closeCompare = () => {
                        themeCompareModal.classList.add('hidden');
                        themeCompareModal.classList.remove('flex');
                    };

                    compareThemeButton.addEventListener('click', openCompare);

                    if (closeThemeCompareModal) {
                        closeThemeCompareModal.addEventListener('click', closeCompare);
                    }

                    themeCompareModal.addEventListener('click', (event) => {
                        if (event.target === themeCompareModal) {
                            closeCompare();
                        }
                    });
                }

                render();
                updateUnsavedState();
            })();
        </script>
    @endif
@endsection
