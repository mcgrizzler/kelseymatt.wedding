<div>
    <form wire:submit="submit">

        {{-- Attending toggle --}}
        <div class="flex gap-4 mb-8">
            <label class="flex-1">
                <input type="radio" name="attending" value="yes" class="sr-only peer"
                       wire:model.live="attending">
                <div class="cursor-pointer rounded-xl border-2 p-4 text-center transition
                            border-sand-200 peer-checked:border-lagoon-500 peer-checked:bg-lagoon-50">
                    <span class="block text-2xl mb-1">🎉</span>
                    <span class="font-medium text-lagoon-800">Joyfully Accepts</span>
                </div>
            </label>
            <label class="flex-1">
                <input type="radio" name="attending" value="no" class="sr-only peer"
                       wire:model.live="attending">
                <div class="cursor-pointer rounded-xl border-2 p-4 text-center transition
                            border-sand-200 peer-checked:border-coral-400 peer-checked:bg-coral-50">
                    <span class="block text-2xl mb-1">💌</span>
                    <span class="font-medium text-lagoon-800">Regretfully Declines</span>
                </div>
            </label>
        </div>

        @error('attending')
            <p class="text-sm text-coral-600 mb-4">{{ $message }}</p>
        @enderror

        {{-- Guest fields (shown when attending) --}}
        @if($attending === 'yes')
            @foreach($guests as $index => $guest)
                <div class="mb-6 rounded-2xl bg-sand-50 ring-1 ring-sand-200 p-5" wire:key="guest-{{ $index }}">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-lagoon-800">
                            {{ $index === 0 ? 'Your Info' : 'Guest ' . $index }}
                        </h3>
                        @if($index > 0)
                            <button type="button" wire:click="removeGuest({{ $index }})"
                                    class="text-sm text-coral-500 hover:text-coral-700 transition">
                                Remove
                            </button>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-lagoon-700 mb-1">
                                Full Name <span class="text-coral-500">*</span>
                            </label>
                            <input type="text"
                                   wire:model="guests.{{ $index }}.name"
                                   class="w-full rounded-xl border border-sand-200 bg-white px-4 py-2.5 text-lagoon-900 focus:border-lagoon-400 focus:outline-none focus:ring-2 focus:ring-lagoon-200"
                                   placeholder="Full name">
                            @error("guests.{$index}.name")
                                <p class="text-sm text-coral-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-lagoon-700 mb-1">
                                Meal Choice <span class="text-coral-500">*</span>
                            </label>
                            <select wire:model="guests.{{ $index }}.meal_choice"
                                    class="w-full rounded-xl border border-sand-200 bg-white px-4 py-2.5 text-lagoon-900 focus:border-lagoon-400 focus:outline-none focus:ring-2 focus:ring-lagoon-200">
                                <option value="">Select a meal…</option>
                                @foreach($mealOptions as $meal)
                                    <option value="{{ $meal }}">{{ $meal }}</option>
                                @endforeach
                            </select>
                            @error("guests.{$index}.meal_choice")
                                <p class="text-sm text-coral-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-lagoon-700 mb-1">
                                Dietary Restrictions
                                <span class="text-lagoon-400 font-normal">(optional)</span>
                            </label>
                            <textarea wire:model="guests.{{ $index }}.dietary_restrictions"
                                      rows="2"
                                      placeholder="Allergies, dietary needs…"
                                      class="w-full rounded-xl border border-sand-200 bg-white px-4 py-2.5 text-lagoon-900 focus:border-lagoon-400 focus:outline-none focus:ring-2 focus:ring-lagoon-200 resize-none"></textarea>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Add guest button --}}
            @if($invite->max_guests > 1 && count($guests) < $invite->max_guests)
                <button type="button"
                        wire:click="addGuest"
                        class="mb-6 flex items-center gap-2 text-sm font-medium text-lagoon-600 hover:text-lagoon-800 transition">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-lagoon-100 text-lagoon-700 text-lg leading-none">+</span>
                    Add another guest
                    <span class="text-lagoon-400">({{ count($guests) }}/{{ $invite->max_guests }})</span>
                </button>
            @endif
        @endif

        {{-- Submit --}}
        <button type="submit"
                class="w-full rounded-full bg-coral-500 px-8 py-3 text-white font-medium shadow-sm hover:bg-coral-600 transition data-loading:opacity-60 data-loading:cursor-wait">
            Confirm RSVP
        </button>

    </form>
</div>
