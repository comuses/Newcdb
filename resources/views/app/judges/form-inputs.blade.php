@php $editing = isset($judge) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $judge->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="years"
            label="Years"
            :value="old('years', ($editing ? $judge->years : ''))"
            max="255"
            placeholder="Years"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="courtID"
            label="Court Id"
            :value="old('courtID', ($editing ? $judge->courtID : ''))"
            maxlength="255"
            placeholder="Court Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="court_id" label="Court" required>
            @php $selected = old('court_id', ($editing ? $judge->court_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Court</option>
            @foreach($courts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
