@php $editing = isset($case1) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="partyID"
            label="Party Id"
            :value="old('partyID', ($editing ? $case1->partyID : ''))"
            maxlength="255"
            placeholder="Party Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="Action"
            label="Action"
            :value="old('Action', ($editing ? $case1->Action : ''))"
            maxlength="255"
            placeholder="Action"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="courtID"
            label="Court Id"
            :value="old('courtID', ($editing ? $case1->courtID : ''))"
            maxlength="255"
            placeholder="Court Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="judgeID"
            label="Judge Id"
            :value="old('judgeID', ($editing ? $case1->judgeID : ''))"
            maxlength="255"
            placeholder="Judge Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="start_date"
            label="Start Date"
            value="{{ old('start_date', ($editing ? optional($case1->start_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="end_date"
            label="End Date"
            value="{{ old('end_date', ($editing ? optional($case1->end_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="caseTyep"
            label="Case Tyep"
            :value="old('caseTyep', ($editing ? $case1->caseTyep : ''))"
            maxlength="255"
            placeholder="Case Tyep"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="caseStatus"
            label="Case Status"
            :value="old('caseStatus', ($editing ? $case1->caseStatus : ''))"
            maxlength="255"
            placeholder="Case Status"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
