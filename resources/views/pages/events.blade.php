@extends('layouts.app')

@section('content')
    <div>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <ol class="breadcrumb" aria-label="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Liste des évènements') }}</li>
                </ol>
            </div>
        </nav>

        <h1>{{ __('Liste des évènements') }}</h1>
        <div class="container-fluid row g-4">
            @foreach ($events as $event)
                <div class="col-6 d-flex align-items-stretch">
                    <div class="card p-4">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h2>{{ $event->id . ' - ' . $event->title }}</h2>
                            @if ($event->start_date <= Carbon\Carbon::today() && $event->end_date > Carbon\Carbon::today())
                                <p><span class="rounded-pill badge bg-info">{{ __('En cours') }}</span></p>
                            @elseif ($event->start_date >= Carbon\Carbon::today())
                                <p><span class="rounded-pill badge bg-success">{{ __('À venir') }}</span></p>
                            @elseif ($event->end_date < Carbon\Carbon::today())
                                <p><span class="rounded-pill badge bg-secondary">{{ __('Terminé') }}</span></p>
                            @endif
                        </div>
                        <div class="card-body">
                            <p>{{ trans_choice('{0} Aucun participant|{1} participant|[2,*] :value participants', $event->total_tickets, ['value' => $event->total_tickets]) }}
                            </p>
                            <p>{{ trans_choice('{0} Complet|{1} dernière place|[2,*] :value places restantes', $event->quantity, ['value' => $event->quantity]) }}
                            </p>
                            <p>{{ $event->price . __('$ / par billet') }}</p>
                            <p>Du <span>{{ $event->start_date }}</span> au <span>{{ $event->end_date }}</span></p>
                            <a class="card-link"
                                href="{{ route('show-event', ['slug' => $event->slug]) }}">{{ __("Voir l'évènement") }}<span
                                    class="ico ico-arrow"></span></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
