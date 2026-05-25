@extends('panel.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-7">
        <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight">Panel de control</h2>
        <p class="text-gray-600 dark:text-gray-300 mt-2">Gestiona contenido y revisa el estado del sitio desde un solo lugar.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        <article class="panel-card p-5">
            <p class="text-sm text-gray-500 dark:text-gray-400">Aplicacion</p>
            <p class="mt-2 text-2xl font-bold {{ $status['app'] === 'up' ? 'text-green-600' : 'text-red-600' }}">{{ strtoupper($status['app']) }}</p>
        </article>

        <article class="panel-card p-5">
            <p class="text-sm text-gray-500 dark:text-gray-400">Mail</p>
            <p class="mt-2 text-2xl font-bold {{ $status['mail'] === 'configured' ? 'text-green-600' : 'text-amber-600' }}">{{ strtoupper($status['mail']) }}</p>
        </article>

        <article class="panel-card p-5">
            <p class="text-sm text-gray-500 dark:text-gray-400">reCAPTCHA</p>
            <p class="mt-2 text-2xl font-bold {{ $status['recaptcha'] === 'configured' ? 'text-green-600' : 'text-amber-600' }}">{{ strtoupper($status['recaptcha']) }}</p>
        </article>
    </div>

    <div class="mt-7 panel-card p-5">
        <h3 class="text-xl font-bold">Accesos rapidos</h3>
        <p class="mt-2 text-gray-600 dark:text-gray-300">Editor de contenido ya habilitado. Puedes guardar borrador y publicar por seccion.</p>
        <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('panel.users.index') }}" class="panel-btn">Usuarios y roles</a>
            <a href="{{ route('panel.content.home.edit') }}" class="panel-btn">Editar Home</a>
            <a href="{{ route('panel.content.about.edit') }}" class="panel-btn">Editar Acerca</a>
            <a href="{{ route('panel.content.footer.edit') }}" class="panel-btn">Editar Footer</a>
            <a href="{{ route('panel.content.menu.edit') }}" class="panel-btn">Editar Menu</a>
            <a href="{{ route('panel.content.theme.edit') }}" class="panel-btn">Editar Estilo</a>
        </div>
    </div>

    <div class="mt-7 panel-card p-5">
        <h3 class="text-xl font-bold">Estado por seccion</h3>
        <p class="mt-2 text-gray-600 dark:text-gray-300">Monitorea si hay version publicada y borrador pendiente.</p>

        @php
            $sectionLabels = [
                'home.content' => 'Home',
                'about.content' => 'Acerca',
                'footer.copy' => 'Footer',
                'menu.items' => 'Menu',
                'theme.settings' => 'Estilo',
            ];
        @endphp

        <div class="mt-4 grid md:grid-cols-2 gap-4">
            @foreach(($sectionStatuses ?? []) as $sectionKey => $sectionStatus)
                <article class="rounded-xl border border-gray-200 dark:border-gray-800 bg-white/70 dark:bg-gray-900/65 p-4">
                    <div class="flex items-center justify-between gap-3">
                        <h4 class="font-bold">{{ $sectionLabels[$sectionKey] ?? $sectionKey }}</h4>
                        <span class="text-xs px-2.5 py-1 rounded-full {{ !empty($sectionStatus['has_published']) ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300' }}">
                            {{ !empty($sectionStatus['has_published']) ? 'Publicado' : 'Sin publicar' }}
                        </span>
                    </div>

                    <div class="mt-3 space-y-1 text-sm text-gray-600 dark:text-gray-300">
                        <p>Version publicada: {{ $sectionStatus['published_version'] ?? '-' }}</p>
                        <p>Ultima publicacion: {{ optional($sectionStatus['published_at'] ?? null)->format('d/m/Y H:i') ?? '-' }}</p>
                        <p>Borrador pendiente: {{ !empty($sectionStatus['has_draft']) ? 'Si' : 'No' }}</p>
                        <p>Ultimo borrador: {{ optional($sectionStatus['draft_updated_at'] ?? null)->format('d/m/Y H:i') ?? '-' }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
