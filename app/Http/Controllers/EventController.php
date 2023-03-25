<?php

namespace App\Http\Controllers;

//use Carbon\Carbon;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        //$events = DB::select("SELECT * FROM events");

        $events = Event::select('events.id', 'events.title', 'events.start_date', 'events.end_date', 'events.price', 'events.quantity', 'events.slug', DB::raw('SUM(json_extract(`reservation`, "$.number_of_tickets")) as total_tickets'))
                ->leftJoin('orders', DB::raw('json_extract(`reservation`, "$.event_id")'), '=', 'events.id')
                ->where('end_date', '>', date('Y-m-d'))
                ->groupBy('events.id', 'events.title', 'events.start_date', 'events.end_date', 'events.price', 'events.quantity', 'events.slug')
                ->orderBy('start_date', 'ASC')
                ->get();

        return view('pages.events', [
            'events' => $events
        ]);
    }


    public function show($slug)
    {
        //$event = Event::where('slug', $slug)->first();
        // À partir de $event, on récupère les réservations associées à cet événement en regroupant les réservations par email et en calculant le nombre de billets réservés par email (total_tickets) et le prix total de la réservation (total_price)
        // $events = Event::select('events.id', 'events.title', 'events.start_date', 'events.end_date', 'events.price', 'events.quantity', 'events.slug', DB::raw('json_extract(`reservation`, "$.event_id")'), DB::raw('SUM(json_extract(`reservation`, "$.number_of_tickets")) as total_tickets'))
        //         ->leftJoin('orders', DB::raw('json_extract(`reservation`, "$.event_id")'), '=', 'events.id')
        //         ->where('events.id', '=', DB::raw('json_extract(`reservation`, "$.event_id")'))
        //         ->groupBy('events.id', 'events.title', 'events.start_date', 'events.end_date', 'events.price', 'events.quantity', 'events.slug', 'orders.reservation')
        //         //->orderBy('start_date', 'ASC')
        //         ->get();
        $events = [];
        $event = Event::where('slug', $slug)->first();
        $reservation = Order::select('reservation')->where('reservation->event_id', '=', $event->id)->get();

                            dd($reservation);
        foreach ($reservations as $reservation) {
            $email = $reservation->reservation[0]['email'];
            $first_name = $reservation->reservation[0]['first_name'];
            $last_name = $reservation->reservation[0]['last_name'];
            $number_of_tickets = $reservation->reservation[0]['number_of_tickets'];
            $total_price = $reservation->reservation[0]['total_price'];

            $events[] = [
                'email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'number_of_tickets' => $number_of_tickets,
                'total_price' => $total_price
            ];
        }


                    dd($events);

        return view('pages.single_event', [
            'event' => $event
        ]);
    }
}