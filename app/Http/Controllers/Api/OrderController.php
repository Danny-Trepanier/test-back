<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Permet à l'utilisateur connecté d'enregistrer une nouvelle réservation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // On diminue le nombre de places disponibles pour l'événement selon le nombre de billets réservés
        $event = Event::find($request->event_id);
        $event->quantity = $event->quantity - $request->number_of_tickets;

        // on vérifie si le nombre de places disponibles est suffisant
        if ($event->quantity >= 0) {
            $order = Order::create([
                'reservation' => json_encode([
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'number_of_tickets' => $request->number_of_tickets,
                    'total_price' => $request->number_of_tickets * $request->price_per_seat,
                    'event_id' => $request->event_id
                ])
            ]);

            $event->save();

            if ($order) {
                return response()->json([
                    'success' => true,
                    'message' => 'Réservation enregistrée avec succès',
                    'data' => $order
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Une erreur s'est produite lors de l'enregistrement de la réservation",
                    'data' => ''
                ], 400);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => "Le nombre de places disponibles pour cet événement est insuffisant",
                'data' => ''
            ], 400);
        }
    }
}