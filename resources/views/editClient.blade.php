<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>Client</h2>
                    <hr class="mt-2 mb-2">
                    <form class="mt-4" method="POST" action="{{ route('updateClient', $client->id) }}">
                        @csrf
                        @method('PUT')
                        <!-- First name input -->
                        <div>
                            <x-input-label for="first_name" :value="__('First name')" />
                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="$client->first_name" />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <!-- Last name -->
                        <div class="mt-4">
                            <x-input-label for="last_name" :value="__('Last name')" />
                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="$client->last_name" />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$client->email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone number -->
                        <div class="mt-4">
                            <x-input-label for="phone_number" :value="__('Phone number')" />
                            <x-text-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number" :value="$client->phone_number" />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <!-- Edit client -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Edit client') }}
                            </x-primary-button>
                        </div>
                    </form>
                    <h2 class="mt-4 mb-4">Products</h2>
                    <h2>Cash loan</h2>
                    <hr class="mt-2 mb-2">
                    @if ($client->cashLoan !== null)
                        <form class="mt-4" method="POST" action="{{ route('updateCashLoan', $client->cashLoan->id) }}">
                            @csrf
                            @method('PUT')
                            <!-- Loan amount input -->
                            <div>
                                <x-input-label for="loan_amount" :value="__('Loan amount')" />
                                <x-text-input id="loan_amount" class="block mt-1 w-full" type="number" name="loan_amount" :value="$client->cashLoan->loan_amount" />
                                <x-input-error :messages="$errors->get('loan_amount')" class="mt-2" />
                            </div>

                            <!-- Update cash loan -->
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('Update cash loan') }}
                                </x-primary-button>
                            </div>
                            <x-input-error :messages="$errors->get('cash_loan')" class="mt-2" />
                        </form>
                    @else
                        <form class="mt-4" method="POST" action="{{ route('createCashLoan', $client->id) }}">
                            @csrf
                            <!-- Loan amount input -->
                            <div>
                                <x-input-label for="loan_amount" :value="__('Loan amount')" />
                                <x-text-input id="loan_amount" class="block mt-1 w-full" type="number" name="loan_amount" :value="$client->loan_amount" />
                                <x-input-error :messages="$errors->get('loan_amount')" class="mt-2" />
                            </div>

                            <!-- Create cash loan -->
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('Create cash loan') }}
                                </x-primary-button>
                            </div>
                            <x-input-error :messages="$errors->get('cash_loan')" class="mt-2" />
                        </form>
                    @endif
                    <h2>Home loan</h2>
                    <hr class="mt-2 mb-2">
                    @if ($client->homeLoan !== null)
                        <form class="mt-4" method="POST" action="{{ route('updateHomeLoan', $client->homeLoan->id) }}">
                            @csrf
                            @method('PUT')
                            <!-- Property value input -->
                            <div>
                                <x-input-label for="property_value" :value="__('Property value')" />
                                <x-text-input id="property_value" class="block mt-1 w-full" type="number" name="property_value" :value="$client->homeLoan->property_value" />
                                <x-input-error :messages="$errors->get('property_value')" class="mt-2" />
                            </div>

                            <!-- Down payment value input -->
                            <div>
                                <x-input-label for="down_payment_amount" :value="__('Down payment value')" />
                                <x-text-input id="down_payment_amount" class="block mt-1 w-full" type="number" name="down_payment_amount" :value="$client->homeLoan->down_payment_amount" />
                                <x-input-error :messages="$errors->get('down_payment_amount')" class="mt-2" />
                            </div>

                            <!-- Update home loan -->
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('Update home loan') }}
                                </x-primary-button>
                            </div>
                            <x-input-error :messages="$errors->get('home_loan')" class="mt-2" />
                        </form>
                    @else
                        <form class="mt-4" method="POST" action="{{ route('createHomeLoan', $client->id) }}">
                            @csrf
                            <!-- Property value input -->
                            <div>
                                <x-input-label for="property_value" :value="__('Property value')" />
                                <x-text-input id="property_value" class="block mt-1 w-full" type="number" name="property_value" :value="$client->property_value" />
                                <x-input-error :messages="$errors->get('property_value')" class="mt-2" />
                            </div>

                            <!-- Down payment value input -->
                            <div>
                                <x-input-label for="down_payment_amount" :value="__('Down payment value')" />
                                <x-text-input id="down_payment_amount" class="block mt-1 w-full" type="number" name="down_payment_amount" :value="$client->down_payment_amount" />
                                <x-input-error :messages="$errors->get('down_payment_amount')" class="mt-2" />
                            </div>

                            <!-- Create home loan -->
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('Create home loan') }}
                                </x-primary-button>
                            </div>
                            <x-input-error :messages="$errors->get('home_loan')" class="mt-2" />
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
