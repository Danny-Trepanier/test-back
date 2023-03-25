@extends('layouts.app')

@section('content')
    <div>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <ol class="breadcrumb" aria-label="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('list-event') }}">{{ __('Liste des évènements') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                </ol>
            </div>
        </nav>
        <div class="card">
            <div class="card-title p-4 d-flex justify-content-between align-items-center">
                <h1>{{ $event->id . ' - ' . $event->title }}</h1>
                @if ($event->start_date <= Carbon\Carbon::today() && $event->end_date > Carbon\Carbon::today())
                    <p><span class="rounded-pill badge bg-info">{{ __('En cours') }}</span></p>
                @elseif ($event->start_date >= Carbon\Carbon::today())
                    <p><span class="rounded-pill badge bg-success">{{ __('À venir') }}</span></p>
                @elseif ($event->end_date < Carbon\Carbon::today())
                    <p><span class="rounded-pill badge bg-alert">{{ __('Terminé') }}</span></p>
                @endif
            </div>
            <div class="card-body">
                <p class="card-text">{{ $event->description }}</p>
                <p>{{ trans_choice('{0} Complet|{1} dernière place|[2,*] :value places restantes', $event->quantity, ['value' => $event->quantity]) }}
                </p>
                <p>{{ $event->price . __('$ / par billet') }}</p>
                <p>Du <span>{{ $event->start_date }}</span> au <span>{{ $event->end_date }}</span></p>
                <p>De <span>{{ $event->start_time }}</span> à <span>{{ $event->end_time }}</span></p>
            </div>
        </div>
    </div>
    <div>
        @if ($event->quantity > 0)
            <form method="post" action="{{ route('order.store') }}">
                @csrf
                <input type="hidden" class="form-control" name="price_per_seat" id="price_per_seat"
                    value="{{ $event->price }}">
                <input type="hidden" class="form-control" name="event_id" id="event_id" value="{{ $event->id }}">
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" class="form-control" name="first_name" id="first_name">
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" class="form-control" name="last_name" id="last_name">
                </div>
                <div class="form-group">
                    <label>Courriel</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label>Nombre de billet</label>
                    <input type="number" min="1" max="{{ $event->quantity }}" class="form-control"
                        name="number_of_tickets" id="number_of_tickets">
                </div>
                <input type="submit" name="reservation" value="Réserver" class="btn btn-dark btn-block">
            </form>
        @else
            <p class="text-center">{{ __('Désolé, cet évènement est complet') }}</p>
        @endif
    </div>
@endsection
