@php $editing = isset($document) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="caseID"
            label="Case Id"
            :value="old('caseID', ($editing ? $document->caseID : ''))"
            maxlength="255"
            placeholder="Case Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="documentType"
            label="Document Type"
            maxlength="255"
            required
            >{{ old('documentType', ($editing ? $document->documentType : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="dateFiled"
            label="Date Filed"
            value="{{ old('dateFiled', ($editing ? optional($document->dateFiled)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $document->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="case1_id" label="Case1" required>
            @php $selected = old('case1_id', ($editing ? $document->case1_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Case1</option>
            @foreach($case1s as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
