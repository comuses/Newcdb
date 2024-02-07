@php $editing = isset($bar) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="attorneyID"
            label="Attorney Id"
            :value="old('attorneyID', ($editing ? $bar->attorneyID : ''))"
            maxlength="255"
            placeholder="Attorney Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="bar"
            label="Bar"
            :value="old('bar', ($editing ? $bar->bar : ''))"
            maxlength="255"
            placeholder="Bar"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="attorney_id" label="Attorney" required>
            @php $selected = old('attorney_id', ($editing ? $bar->attorney_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Attorney</option>
            @foreach($attorneys as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
