<x-app-layout>
    <div class=" mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Book Work Space</h1>

        <section class="grid md:grid-cols-3 gap-5">
            <div class="md:col-span-2 bg-white rounded-lg shadow-md p-6 space-y-5">
                <h2 class="text-lg font-bold">
                    {{ $space->name }}
                    <span
                        class="border-2 border-[#25a0db]  text-[#25a0db] rounded-full px-3 py-0.5 text-sm font-bold mx-3">
                        # <span id="total_price"></span> / day

                    </span>
                </h2>

                {{-- <form action="{{ route('bookings.store') }}" method="POST" id="paymentForm"> --}}
                <form id="paymentForm">
                    <input type="hidden" name="space_id" value="{{ $space->id }}">

                    <div class="w-full mx-auto mb-8">
                        <div class="flex mb-4">
                            <label for="days_count" class="mb-2 text-sm font-medium text-gray-900 sr-only ">
                                No. od days</label>
                            <div class="relative w-full">
                                <input type="number" id="days_count" name="days_count"
                                    class="block p-2.5 w-full z-20 text- border-2 border-gray-200 text-gray-900  rounded-lg  border-s-2  focus:ring-[#25a0db] focus:border-[#25a0db] "
                                    placeholder="No. of days" value="10" required readonly />
                            </div>
                        </div>
                        <div class="relative">
                            <label for="days_range" class="sr-only">Default range</label>
                            <input id="days_range" type="range" value="10" min="1" max="30"
                                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                            <span class="text-sm text-gray-500  absolute start-0 -bottom-6">Min (1day)</span>
                            <span
                                class="text-sm text-gray-500  absolute start-1/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">10</span>
                            <span
                                class="text-sm text-gray-500  absolute start-2/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">20</span>
                            <span class="text-sm text-gray-500  absolute end-0 -bottom-6">Max (30days)</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="font-medium text-sm mb-2 ml-1">Email</label>
                        <div>
                            <input
                                class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:ring-[#25a0db] focus:border-[#25a0db] transition-colors"
                                placeholder="Jexample.me@gmail.com" type="email" id="email-address" required />
                        </div>
                    </div>


                    <div>
                        <div class="mb-3">
                            <div>
                                <input
                                    class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:ring-[#25a0db] focus:border-[#25a0db] transition-colors"
                                    placeholder="1000" type="hidden" id="amount" required />
                            </div>
                        </div>
                    </div>

                    <button type="button" id="submit_button" onclick="payWithPaystack(event)" class="btn-basic">Confirm
                        Booking {{ $space->price_per_day }}</button>

                </form>

            </div>
            <div class="md:col-span-1 bg-white rounded-lg shadow-md p-6">
                <div class="h-[300px]">
                    <img src="{{ asset('storage/' . $space->image) }}" alt="{{ $space->name }}"
                        class="w-full h-48 object-cover rounded-lg border-2 border-[#25a0db]">
                </div>
            </div>
        </section>



    </div>


    <script>
        var price_per_day = @js($space->price_per_day);

        var rangeInput = document.getElementById('days_range');
        var currencyInput = document.getElementById('days_count');
        var totalPriceSpan = document.getElementById('total_price');
        var amountInput = document.getElementById('amount');
        var buttonValue = document.getElementById('submit_button');


        amountInput.value = price_per_day
        buttonValue.innerHTML = 'Pay ' + price_per_day
        totalPriceSpan.innerHTML = price_per_day;

        function updateDaysInput() {
            currencyInput.value = rangeInput.value;
            var totalPrice = rangeInput.value * price_per_day;
            totalPriceSpan.textContent = totalPrice.toFixed(2); // Display the total price
            buttonValue.textContent = 'Pay ' + totalPrice.toFixed(2); // Display the total price
            amountInput.value = totalPrice.toFixed(2);
        }

        rangeInput.addEventListener('input', updateDaysInput);
    </script>


    <script src="https://js.paystack.co/v2/inline.js"></script>
    <script>
        if (currencyInput.value !== null) {
            
            function payWithPaystack(e) {
                e.preventDefault();
    
                let handler = PaystackPop.setup({
                    key: 'pk_test_a683d1e021670d61207a3fb1241bf4d23c92ca40', // Replace with your public key
                    email: document.getElementById("email-address").value,
                    amount: document.getElementById("amount").value * 100,
                    ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference
                    onClose: function() {
                        alert('Window closed.');
                    },
                    callback: function(response) {
                        let message = 'Payment complete! Reference: ' + response.reference;
                        // console.log('this is it' + message);
    
    
                        let data = {
                            reference: response.reference,
                            email: document.getElementById("email-address").value,
                            total_amount: document.getElementById("amount").value,
                            space_id: @js($space->id),
                            days_count: currencyInput.value,
                            _token: '{{ csrf_token() }}'
                        };
    
                        // Submit the data to your server route
                        let creatRoute = "{{ route('bookings.store') }}";
                        fetch(creatRoute, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(data) // Send the data as JSON
                            })
                            .then(response => {
                                if (response.ok) {
                                    return response.json();
    
                                } else {
                                    throw new Error('Payment submission failed.');
                                }
                            })
                            .then(data => {
                                if (data.success) {
                                    console.log('Server response:', data.message);
    
                                    alert(data.message); // Display the success message to the user
                                    setInterval(() => {
                                        // location.reload();
                                    }, 1000);
                                } else {
                                    console.error('Server error:', data.message);
                                    setInterval(() => {
                                        location.reload();
                                    }, 1000);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    }
                });
    
                handler.openIframe();
            }
        }
    </script>


</x-app-layout>
