{!! view_render_event('bagisto.shop.checkout.onepage.shipping.before') !!}

<v-shipping-methods
    :methods="shippingMethods"
    @processing="stepForward"
    @processed="stepProcessed"
>
    <!-- Shipping Method Shimmer Effect -->
    <x-shop::shimmer.checkout.onepage.shipping-method />
</v-shipping-methods>

{!! view_render_event('bagisto.shop.checkout.onepage.shipping.after') !!}

@pushOnce('scripts')
    <script type="text/x-template" id="v-shipping-methods-template">
        <div class="mb-7 max-md:mb-0">
            <template v-if="!methods">
                <!-- Shimmer effect saat loading -->
                <div>Loading shipping methods...</div>
            </template>

            <template v-else>
                <div class="overflow-hidden border-b-0 max-md:rounded-lg max-md:border-none max-md:bg-gray-100">
                    <!-- Header -->
                    <div class="px-0 py-4 max-md:p-3 max-md:text-sm max-md:font-medium max-sm:p-2">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-medium max-md:text-base">
                                "{{ __('shop::app.checkout.onepage.shipping.shipping-method') }}"

                            </h2>
                        </div>
                    </div>

                    <!-- Shipping Methods -->
                    <div class="mt-8 p-0 max-md:mt-0 max-md:rounded-t-none max-md:border max-md:border-t-0 max-md:p-4">
                        <div class="flex flex-wrap gap-8 max-md:gap-4 max-sm:gap-2.5">
                            <template v-for="method in methods" :key="method.method_title">
                                <div
                                    class="relative max-w-[218px] select-none max-md:max-w-full max-md:flex-auto"
                                    v-for="rate in method.rates"
                                    :key="@{{ rate.method }}"
                                >
                                    <input 
                                        type="radio"
                                        name="shipping_method"
                                        :id="@{{ rate.method }}"
                                        :value="@{{ rate.method }}"
                                        class="peer hidden"
                                        @change="store(rate.method)"
                                    >

                                    <label 
                                        class="icon-radio-unselect peer-checked:icon-radio-select absolute top-5 cursor-pointer text-2xl text-navyBlue ltr:right-5 rtl:left-5"
                                        :for="@{{ rate.method }}"
                                    ></label>

                                    <label 
                                        class="block cursor-pointer rounded-xl border border-zinc-200 p-5 max-sm:flex max-sm:gap-4 max-sm:rounded-lg max-sm:px-4 max-sm:py-2.5"
                                        :for="@{{ rate.method }}"
                                    >
                                        <span class="icon-flate-rate text-6xl text-navyBlue max-sm:text-5xl"></span>

                                        <div>
                                            <p class="mt-1.5 text-2xl font-semibold max-md:text-base">
                                                @{{ rate.base_formatted_price }}
                                            </p>
                                            
                                            <p class="mt-2.5 text-xs font-medium max-md:mt-1 max-sm:mt-0 max-sm:font-normal max-sm:text-zinc-500">
                                                <span class="font-medium">@{{ rate.method_title }}</span> - @{{ rate.method_description }}
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </script>

    <script type="module">
        app.component('v-shipping-methods', {
            template: '#v-shipping-methods-template',

            props: {
                methods: {
                    type: Object,
                    required: true,
                    default: () => null,
                },
            },

            emits: ['processing', 'processed'],

            data() {
                return {
                    translations: {
                        shipping_label: "{{ __('shop::app.checkout.onepage.shipping.shipping-method') }}"
                    }
                }
            },

            methods: {
                store(selectedMethod) {
                    this.$emit('processing', 'payment');

                    this.$axios.post("{{ route('shop.checkout.onepage.shipping_methods.store') }}", {    
                            shipping_method: selectedMethod,
                        })
                        .then(response => {
                            if (response.data.redirect_url) {
                                window.location.href = response.data.redirect_url;
                            } else {
                                this.$emit('processed', response.data.payment_methods);
                            }
                        })
                        .catch(error => {
                            this.$emit('processing', 'shipping');

                            if (error.response.data.redirect_url) {
                                window.location.href = error.response.data.redirect_url;
                            }
                        });
                },
            },
        });
    </script>
@endPushOnce


