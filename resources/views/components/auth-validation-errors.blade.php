@props(['errors'])

@if ($errors && $errors->any())
    <div {{ $attributes->merge(['class' => 'font-medium text-red-600']) }}>
        <div class="font-semibold">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
