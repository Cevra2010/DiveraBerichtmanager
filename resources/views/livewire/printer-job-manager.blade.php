<div>
    @if(count($jobs))
        <x-headline text="Aktive Jobs" />
        <p class="m-3 text-gray-500 mt-10">
            <b>Info: </b>Es kann bis zu einer Minute dauern, bis der Druckauftrag erteilt wird.
        </p>
        <table class="table mb-10">
            <thead>
            <tr>
                <th>Datei</th>
                <th class="text-right"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($jobs as $job)
                <tr @if($loop->odd) class="bg-gray-200" @endif>
                    <td>{{ $job->file }}</td>
                    <td class="text-right">
                        <button class="btn btn-red" wire:click="abort({{ $job->id }})">Druck abbrechen</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <x-headline text="Druckvorlagen" />
    @if(count($jobs))
        <p class="text-gray-500 m-3 pt-4">Bitte warten Sie, bis der aktive Job beendet ist.</p>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Datei</th>
                <th class="text-right"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
                <tr @if($loop->odd) class="bg-gray-200" @endif>
                    <td>{{ $file->title }}</td>
                    <td class="text-right">
                        @if(count($jobs))
                        <button class="btn btn-gray cursor-not-allowed">Drucken</button>
                        @else
                        <button class="btn btn-green" wire:click="print({{ $file->id }})">Drucken</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
