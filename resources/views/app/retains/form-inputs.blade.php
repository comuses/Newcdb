@php $editing = isset($retain) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="attorneyID"
            label="Attorney Id"
            :value="old('attorneyID', ($editing ? $retain->attorneyID : ''))"
            maxlength="255"
            placeholder="Attorney Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="caseID"
            label="Case Id"
            :value="old('caseID', ($editing ? $retain->caseID : ''))"
            maxlength="255"
            placeholder="Case Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="emplooyID"
            label="Emplooy Id"
            :value="old('emplooyID', ($editing ? $retain->emplooyID : ''))"
            maxlength="255"
            placeholder="Emplooy Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($retain->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="case1_id" label="Case1" required>
            @php $selected = old('case1_id', ($editing ? $retain->case1_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Case1</option>
            @foreach($case1s as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="attorney_id" label="Attorney" required>
            @php $selected = old('attorney_id', ($editing ? $retain->attorney_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Attorney</option>
            @foreach($attorneys as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="employee_id" label="Employee" required>
            @php $selected = old('employee_id', ($editing ? $retain->employee_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Employee</option>
            @foreach($employees as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
