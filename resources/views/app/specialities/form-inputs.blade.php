@php $editing = isset($speciality) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="attorneyID"
            label="Attorney Id"
            :value="old('attorneyID', ($editing ? $speciality->attorneyID : ''))"
            maxlength="255"
            placeholder="Attorney Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="speciality"
            label="Speciality"
            :value="old('speciality', ($editing ? $speciality->speciality : ''))"
            maxlength="255"
            placeholder="Speciality"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="attorney_id" label="Attorney" required>
            @php $selected = old('attorney_id', ($editing ? $speciality->attorney_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Attorney</option>
            @foreach($attorneys as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
