// Live countdown to the wedding day.
function initCountdown() {
    const el = document.getElementById('countdown');
    if (!el) return;

    const target = new Date(el.dataset.date).getTime();
    const units = {
        days: el.querySelector('[data-unit="days"]'),
        hours: el.querySelector('[data-unit="hours"]'),
        minutes: el.querySelector('[data-unit="minutes"]'),
        seconds: el.querySelector('[data-unit="seconds"]'),
    };

    const pad = (n) => String(n).padStart(2, '0');

    function tick() {
        let diff = Math.max(0, target - Date.now());
        const day = Math.floor(diff / 86400000); diff -= day * 86400000;
        const hr = Math.floor(diff / 3600000); diff -= hr * 3600000;
        const min = Math.floor(diff / 60000); diff -= min * 60000;
        const sec = Math.floor(diff / 1000);

        units.days.textContent = day;
        units.hours.textContent = pad(hr);
        units.minutes.textContent = pad(min);
        units.seconds.textContent = pad(sec);
    }

    tick();
    setInterval(tick, 1000);
}

// Hide guest/meal fields when the guest declines.
function initRsvpToggle() {
    const fields = document.getElementById('attending-fields');
    const group = document.getElementById('attending-group');
    if (!fields || !group) return;

    function sync() {
        const declined = group.querySelector('input[name="attending"]:checked')?.value === 'no';
        fields.classList.toggle('hidden', declined);
    }

    group.addEventListener('change', sync);
    sync();
}

document.addEventListener('DOMContentLoaded', () => {
    initCountdown();
    initRsvpToggle();
});
