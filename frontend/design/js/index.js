(() => {
  // Set DEMO_MODE to false once your backend login route exists.
  const DEMO_MODE = true;
  const API_URL = '/api/auth/login';
  const NEXT_PAGE = 'dashboard.html';

  const $ = (s) => document.querySelector(s);
  const scene = $('#scene');
  const form = $('#loginForm'), email = $('#email'), pass = $('#password');
  const toggle = $('#toggle'), submit = $('#submit'), formErr = $('#formErr');
  const caps = $('#capsHint');
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Vehicles drive forward as the form gets filled in.
  const updateProgress = () => {
    const p = (email.value.trim() ? 0.4 : 0) + (pass.value ? 0.4 : 0);
    scene.style.setProperty('--p', p);
  };
  email.addEventListener('input', updateProgress);
  pass.addEventListener('input', updateProgress);

  // Headlights switch on while the password field is active.
  pass.addEventListener('focus', () => scene.classList.add('lights'));
  pass.addEventListener('blur',  () => { scene.classList.remove('lights'); caps.hidden = true; });

  // Caps Lock warning.
  const checkCaps = (e) => { caps.hidden = !e.getModifierState('CapsLock'); };
  pass.addEventListener('keydown', checkCaps);
  pass.addEventListener('keyup', checkCaps);

  // Click a vehicle to rev it.
  document.querySelectorAll('.ride').forEach((r) => {
    r.addEventListener('click', () => {
      r.classList.remove('rev');
      void r.offsetWidth;
      r.classList.add('rev');
    });
  });

  // Show or hide the password.
  toggle.addEventListener('click', () => {
    const show = pass.type === 'password';
    pass.type = show ? 'text' : 'password';
    toggle.textContent = show ? 'Hide' : 'Show';
    toggle.setAttribute('aria-pressed', String(show));
  });

  // Hills shift slightly with the pointer.
  if (!reduce) {
    addEventListener('pointermove', (e) => {
      const x = e.clientX / innerWidth - 0.5;
      document.querySelectorAll('.hills').forEach((h) => {
        h.style.transform = `translateX(${-x * h.dataset.depth * 2}px)`;
      });
    });
  }

  const setError = (input, errEl, msg) => {
    errEl.textContent = msg;
    input.closest('.field').classList.toggle('bad', !!msg);
  };

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    formErr.textContent = '';
    const emailMsg = !email.value.trim() ? 'Enter your email.'
      : !email.validity.valid ? 'Enter a valid email, like you@example.com.' : '';
    const passMsg = pass.value ? '' : 'Enter your password.';
    setError(email, $('#emailErr'), emailMsg);
    setError(pass, $('#passErr'), passMsg);
    if (emailMsg || passMsg) { (emailMsg ? email : pass).focus(); return; }

    submit.disabled = true;
    submit.textContent = 'Signing in…';
    try {
      if (!DEMO_MODE) {
        const res = await fetch(API_URL, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ email: email.value.trim(), password: pass.value }),
        });
        if (!res.ok) throw new Error(res.status === 401 ? 'bad' : 'server');
      }
      scene.classList.add('leaving');            // vehicles drive off screen
      setTimeout(() => { location.href = NEXT_PAGE; }, reduce ? 200 : 1200);
    } catch (err) {
      formErr.textContent = err.message === 'bad'
        ? 'Email or password is incorrect. Check them and try again.'
        : 'Can’t reach the server. Check your connection and try again.';
      submit.disabled = false;
      submit.textContent = 'Sign in';
    }
  });
})();