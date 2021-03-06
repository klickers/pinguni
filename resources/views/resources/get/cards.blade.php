@if (!empty($cards))
    <div id = "card-wrap" class = "card-group-wrapper mt-2">
        @foreach ($cards as $card)
            <x-card
                  width="full"
                  height="h-long"
                  :card="$card" >
            </x-card>
        @endforeach
    </div>
    {{ $cards->links() }}
@endif
