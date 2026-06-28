<x-frontend-layout>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-slate-800 dark:text-white">My Orders</h1>
            <span class="text-sm text-gray-500 dark:text-gray-400">Total Orders: {{ $orders->total() }}</span>
        </div>

        <div class="flex flex-col bg-white dark:bg-gray-800 p-5 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        @if($orders->count() > 0)
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr class="bg-gray-50 dark:bg-gray-700/50">
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order #</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order Status</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Payment Status</th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Amount</th>
                                        <th scope="col" class="px-6 py-3 text-end text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($orders as $order)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                #{{ $order->id }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm text-gray-600 dark:text-gray-300">
                                                {{ $order->created_at->format('M d, Y') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusColors = [
                                                    'new' => 'bg-blue-500',
                                                    'processing' => 'bg-yellow-500',
                                                    'shipped' => 'bg-purple-500',
                                                    'delivered' => 'bg-green-500',
                                                    'canceled' => 'bg-red-500',
                                                ];
                                                $statusColor = $statusColors[$order->status] ?? 'bg-gray-500';
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium text-white {{ $statusColor }}">
                                                <span class="w-1.5 h-1.5 rounded-full bg-white/30 mr-1.5"></span>
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $paymentColors = [
                                                    'pending' => 'bg-yellow-500',
                                                    'paid' => 'bg-green-500',
                                                    'failed' => 'bg-red-500',
                                                    'refunded' => 'bg-orange-500',
                                                ];
                                                $paymentColor = $paymentColors[$order->payment_status] ?? 'bg-gray-500';
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium text-white {{ $paymentColor }}">
                                                <span class="w-1.5 h-1.5 rounded-full bg-white/30 mr-1.5"></span>
                                                {{ ucfirst($order->payment_status ?? 'Pending') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                                Rs. {{ number_format($order->grand_total ?? 0, 2) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end">
                                            <a href="{{ route('order.details', $order->id) }}"
                                               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="mt-6">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="text-center py-12">
                                <div class="flex justify-center mb-4">
                                    <svg class="w-24 h-24 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">No Orders Yet</h3>
                                <p class="text-gray-500 dark:text-gray-400 mt-2">You haven't placed any orders yet.</p>
                                <a href="{{ route('products') }}" class="mt-4 inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                    Start Shopping
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>