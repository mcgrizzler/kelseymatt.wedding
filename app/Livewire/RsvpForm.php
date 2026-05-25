<?php

namespace App\Livewire;

use App\Enums\RsvpStatus;
use App\Models\Invite;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

class RsvpForm extends Component
{
    public Invite $invite;

    public string $attending = '';

    /** @var array<int, array{name: string, meal_choice: string, dietary_restrictions: string}> */
    public array $guests = [];

    public function mount(): void
    {
        $this->guests = [
            ['name' => $this->invite->name, 'meal_choice' => '', 'dietary_restrictions' => ''],
        ];
    }

    public function addGuest(): void
    {
        if (count($this->guests) < $this->invite->max_guests) {
            $this->guests[] = ['name' => '', 'meal_choice' => '', 'dietary_restrictions' => ''];
        }
    }

    public function removeGuest(int $index): void
    {
        if ($index > 0 && isset($this->guests[$index])) {
            array_splice($this->guests, $index, 1);
        }
    }

    public function submit(): void
    {
        $mealOptions = config('wedding.meal_options', []);

        $this->validate([
            'attending' => ['required', 'in:yes,no'],
            'guests' => ['required_if:attending,yes', 'array', 'min:1', 'max:'.$this->invite->max_guests],
            'guests.*.name' => ['required_if:attending,yes', 'string', 'max:255'],
            'guests.*.meal_choice' => ['required_if:attending,yes', Rule::in($mealOptions)],
            'guests.*.dietary_restrictions' => ['nullable', 'string', 'max:1000'],
        ]);

        $attending = $this->attending === 'yes';

        $this->invite->guests()->delete();

        if ($attending) {
            foreach ($this->guests as $index => $guestData) {
                $this->invite->guests()->create([
                    'name' => $guestData['name'],
                    'meal_choice' => $guestData['meal_choice'],
                    'dietary_restrictions' => $guestData['dietary_restrictions'] ?? null,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        $this->invite->update([
            'rsvp_status' => $attending ? RsvpStatus::Confirmed : RsvpStatus::Declined,
            'rsvp_submitted_at' => now(),
        ]);

        $this->redirect(route('rsvp.confirm', $this->invite->token));
    }

    public function render(): View
    {
        return view('livewire.rsvp-form', [
            'mealOptions' => config('wedding.meal_options', []),
        ]);
    }
}
