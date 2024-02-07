@php $editing = isset($event) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="caseID"
            label="Case Id"
            :value="old('caseID', ($editing ? $event->caseID : ''))"
            maxlength="255"
            placeholder="Case Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="eventType"
            label="Event Type"
            :value="old('eventType', ($editing ? $event->eventType : ''))"
            maxlength="255"
            placeholder="Event Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($event->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="time"
            label="Time"
            :value="old('time', ($editing ? $event->time : ''))"
            maxlength="255"
            placeholder="Time"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="location"
            label="Location"
            :value="old('location', ($editing ? $event->location : ''))"
            maxlength="255"
            placeholder="Location"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="outcome"
            label="Outcome"
            :value="old('outcome', ($editing ? $event->outcome : ''))"
            maxlength="255"
            placeholder="Outcome"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="case1_id" label="Case1" required>
            @php $selected = old('case1_id', ($editing ? $event->case1_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Case1</option>
            @foreach($case1s as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
