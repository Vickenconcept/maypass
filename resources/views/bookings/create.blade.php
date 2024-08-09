<x-app-layout>
    <div class=" mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Book Work Space</h1>

        <section class="grid md:grid-cols-3 gap-5">
            <div class="md:col-span-2 bg-white rounded-lg shadow-md p-6 space-y-5">
                <h2 class="text-lg font-bold">
                    {{ $space->name }}
                    <span
                        class="border-2 border-[#25a0db]  text-[#25a0db] rounded-full px-3 py-0.5 text-sm font-bold mx-3">
                        ${{ $space->price_per_day }} / day
                    </span>
                </h2>

                {{-- <form action="{{ route('bookings.store') }}" method="POST" id="paymentForm"> --}}
                <form id="paymentForm">
                    <input type="hidden" name="space_id" value="{{ $space->id }}">

                    <div class="mb-4">
                        <label class="font-medium text-sm mb-2 ml-1">Email</label>
                        <div>
                            <input
                                class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                                placeholder="Jexample.me@gmail.com" type="email" id="email-address" required />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700"> Start Date</label>
                        <input type="date" name="start_date" id="start_date"
                            class="border-2 border-gray-200 rounded-m mt-1 block w-full  rounded-lg shadow-sm focus:ring-[#25a0db] focus:border-[#25a0db] "
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700"> end_date</label>
                        <input type="date" name="end_date" id="end_date"
                            class="border-2 border-gray-200 rounded-m mt-1 block w-full  rounded-lg shadow-sm focus:ring-[#25a0db] focus:border-[#25a0db] "
                            required>
                    </div>


                    <div>

                        <div class="mb-3">
                            <div>
                                <input
                                    class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                                    placeholder="1000" type="text" id="amount" value="{{ $space->price_per_day }}"
                                    required />
                            </div>
                        </div>
                    </div>

                    {{-- <div class="mb-4">
                        <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment
                            Method</label>
                        <select name="payment_method" id="payment_method"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-[#25a0db] focus:border-[#25a0db] " required>
                            <option value="credit_card">Credit Card</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div> --}}

                    <button type="button" onclick="payWithPaystack(event)" class="btn-basic">Confirm
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



    {{-- <script src="https://js.paystack.co/v1/inline.js"></script> --}}
    <script src="https://js.paystack.co/v2/inline.js"></script>
    <script>
        // const paymentForm = document.getElementById('paymentForm');
        // paymentForm.addEventListener("submit", payWithPaystack, false);


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
                    alert(message);
                    // Handle payment success
                }
            });

            handler.openIframe();
        }


        // function payWithPaystack(e) {
        //     e.preventDefault();

        //     let handler = PaystackPop.setup({
        //         key: 'pk_test_a683d1e021670d61207a3fb1241bf4d23c92ca40', // Replace with your public key
        //         email: document.getElementById("email-address").value,
        //         amount: document.getElementById("amount").value * 100,
        //         ref: '' + Math.floor((Math.random() * 1000000000) +
        //             1
        //         ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        //         // label: "Optional string that replaces customer email"
        //         onClose: function() {
        //             alert('Window closed.');
        //         },
        //         callback: function(response) {
        //             let message = 'Payment complete! Reference: ' + response.reference;
        //             alert(message);



        //             // setInterval(() => {
        //             //     location.reload();
        //             // }, 1000);

        //         }
        //     });

        //     handler.openIframe();
        // }
    </script>
</x-app-layout>
