
<button id="backToTop" 
    class="hidden fixed bottom-6 right-6 z-50 bg-blue-600 text-white p-4 cursor-pointer rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300">
    <i class="fa-solid fa-arrow-up h-5 w-6 text-xl"></i>
</button>

<x-layout>
 <section class="hero-section relative h-screen flex items-center justify-center pt-2 bg-cover bg-center" style="background-image: url('{{ asset('images/register.jpg') }}');">
<div class="absolute inset-0 bg-black opacity-70 "></div>
  <div class="container mx-auto flex justify-between items-center h-full px-2 md:px-6 relative z-10">
     <!-- Left side -->
    <div class="text-center flex-1   lg:text-left space-y-8 text-white lg:text-blue-950">
      <div class="space-y-4"> 
        <h1 class="hero-title text-5xl lg:text-7xl font-bold leading-tight">
          <span class="block text-white">Barangay</span>
          <span class="text-sky-300" id="e-services">E-Services</span>
        </h1>
      </div>
      <p class="hero-subtitle text-xl max-w-2xl leading-relaxed text-blue-100 lg:text-white">
Barangay e-Services is an online platform primarily established to provide residents with efficient access to essential barangay services. It is designed to streamline administrative processes, reduce waiting times, promote faster and more convenient transactions within the community.
      </p>   
    </div>

      <!-- Right side -->
<div class="slider relative w-full h-[700px] flex-1 items-center justify-center overflow-hidden hidden md:flex">
  <div class="w-full h-full relative">
    <div class="swiper-wrapper relative">

      <!-- CARD 1 -->
      <div class="item  absolute left-1/2 top-1/2 w-[350px] bg-white rounded-2xl text-black shadow-[0_8px_32px_rgba(0,0,0,0.9)] border border-white/10 overflow-hidden transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)]">
        <img src="https://images.unsplash.com/photo-1544027993-37dbfe43562a?w=800&q=80"
          class="w-full h-[250px] object-cover rounded-t-2xl" />
        <div class="p-8">
          <h3 class="text-2xl font-light uppercase tracking-wide mb-4 text-neutral-900">Certificate of Indigency </h3>
          <p class="text-sm leading-relaxed text-neutral-600 font-light">
            Issued to residents below the poverty threshold for financial assistance or government support.
          </p>
        </div>
      </div>
            <!-- CARD 7 -->
            <div class="item absolute left-1/2 top-1/2 w-[350px] bg-white rounded-2xl text-black shadow-[0_8px_32px_rgba(0,0,0,0.9)] border border-white/10 overflow-hidden transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)]">
            <img src="https://images.unsplash.com/photo-1581090700227-1e37b190418e?w=800&q=80"
                alt="Barangay Clearance Document"
                class="w-full h-[250px] object-cover rounded-t-2xl" />

            <div class="p-8">
                <h3 class="text-2xl font-light uppercase tracking-wide mb-4 text-neutral-900">Barangay Clearance</h3>
                <p class="text-sm leading-relaxed text-neutral-600 font-light">
                Proof that a resident or business has no pending cases or obligations within the Barangay.
                </p>
            </div>
            </div>
      <!-- CARD 2 -->
      <div class="item absolute left-1/2 top-1/2 w-[350px] bg-white rounded-2xl text-black shadow-[0_8px_32px_rgba(0,0,0,0.9)] border border-white/10 overflow-hidden transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)]">
        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&q=80"
          class="w-full h-[250px] object-cover rounded-t-2xl" />
        <div class="p-8">
          <h3 class="text-2xl font-light uppercase tracking-wide mb-4 text-neutral-900">Certificate of Residency</h3>
          <p class="text-sm leading-relaxed text-neutral-600 font-light">
            Certifies residence within the Barangay for legal purposes such as enrollment or employment.
          </p>
        </div>
      </div>

      <!-- CARD 3 -->
      <div class="item absolute left-1/2 top-1/2 w-[350px] bg-white rounded-2xl text-black shadow-[0_8px_32px_rgba(0,0,0,0.9)] border border-white/10 overflow-hidden transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)]">
        <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=800&q=80"
          class="w-full h-[250px] object-cover rounded-t-2xl" />
        <div class="p-8">
          <h3 class="text-2xl font-light uppercase tracking-wide mb-4 text-neutral-900">First Time Job Seeker</h3>
          <p class="text-sm leading-relaxed text-neutral-600 font-light">
            Issued to individuals seeking employment for the first time to avail benefits under government programs.
          </p>
        </div>
      </div>

      <!-- CARD 4 -->
      <div class="item absolute left-1/2 top-1/2 w-[350px] bg-white rounded-2xl text-black shadow-[0_8px_32px_rgba(0,0,0,0.9)] border border-white/10 overflow-hidden transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)]">
        <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&q=80"
          class="w-full h-[250px] object-cover rounded-t-2xl" />
        <div class="p-8">
          <h3 class="text-2xl font-light uppercase tracking-wide mb-4 text-neutral-900">Cedula</h3>
          <p class="text-sm leading-relaxed text-neutral-600 font-light">
            Proof of payment for community tax, required for various transactions in the Philippines.
          </p>
        </div>
      </div>

      <!-- CARD 5 -->
      <div class="item absolute left-1/2 top-1/2 w-[350px] bg-white rounded-2xl text-black shadow-[0_8px_32px_rgba(0,0,0,0.9)] border border-white/10 overflow-hidden transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)]">
        <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=800&q=80"
          class="w-full h-[250px] object-cover rounded-t-2xl" />
        <div class="p-8">
          <h3 class="text-2xl font-light uppercase tracking-wide mb-4 text-neutral-900">Barangay ID</h3>
          <p class="text-sm leading-relaxed text-neutral-600 font-light">
            A valid identification card issued to residents of the Barangay, used for official purposes within the community.
          </p>
        </div>
      </div>

      <!-- CARD 6 -->
      <div class="item absolute left-1/2 top-1/2 w-[350px] bg-white rounded-2xl text-black shadow-[0_8px_32px_rgba(0,0,0,0.9)] border border-white/10 overflow-hidden transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)]">
        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&q=80"
          class="w-full h-[250px] object-cover rounded-t-2xl" />
        <div class="p-8">
          <h3 class="text-2xl font-light uppercase tracking-wide mb-4 text-neutral-900">Business Permit</h3>
          <p class="text-sm leading-relaxed text-neutral-600 font-light">
            Certifies that a business is legally registered and authorized to operate within the Barangay, ensuring compliance with local regulations.
          </p>
        </div>
      </div>
      

       
    </div>
  </div>
</div>
<script>
  const items = document.querySelectorAll('.item');
  let active = 0;
  const total = items.length;
  let isAnimating = false;

  // Reset all cards except current + next stack
  function resetStyles() {
    items.forEach((item, index) => {
      item.style.transition = 'transform 0.8s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.6s ease';
      item.style.willChange = 'transform, opacity';
      item.style.opacity = index === active ? '1' : '0';
      item.style.zIndex = index === active ? '10' : '0';
    });
  }

  function animateCurrent(direction) {
    const current = items[active];
    const startY = direction === 'next' ? '-80%' : '80%';
    current.style.transform = `translate(-50%, ${startY}) scale(0.9)`;
    current.style.opacity = '0';

    requestAnimationFrame(() => {
      current.style.opacity = '1';
      current.style.zIndex = '10';
      current.style.transition = 'transform 0.8s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.8s ease';
      current.style.transform = 'translate(-50%, -50%) scale(1)';
    });
  }

  function stackNextCards() {
    for (let i = 1; i <= 3; i++) {
      const nextIndex = (active + i) % total;
      const offsetX = 140 * i;
      const scale = 1 - 0.1 * i;
      const item = items[nextIndex];
      item.style.opacity = '1';
      item.style.zIndex = `${10 - i}`;
      item.style.transition = 'transform 0.8s cubic-bezier(0.25, 1, 0.5, 1)';
      item.style.transform = `translate(calc(-50% + ${offsetX}px), -50%) scale(${scale})`;
    }
  }

  function fadePreviousCards(prevActive) {
    const leaving = items[prevActive];
    leaving.style.transition = 'transform 0.6s ease-in, opacity 0.6s ease-in';
    leaving.style.opacity = '0';
    leaving.style.transform = 'translate(-50%, 80%) scale(0.7)';
  }

  function loadShow(direction = 'next') {
    if (isAnimating) return;
    isAnimating = true;

    const prevActive = active;
    active = (active + 1) % total;

    resetStyles();
    animateCurrent(direction);
    stackNextCards();
    fadePreviousCards(prevActive);

    setTimeout(() => {
      isAnimating = false;
    }, 900);
  }

  // Start auto loop
  setInterval(() => loadShow('next'), 3000);

  // Initialize first view
  resetStyles();
  animateCurrent();
  stackNextCards();
</script>

  </div>

  
</section>
<section id="news-section" class="py-20 bg-white">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-16">
            <div class="inline-flex items-center rounded-full px-4 py-1 mb-4 bg-indigo-100 text-sky-800 border-sky-200">
                <i class='bx bx-info-circle mr-1'></i>
                Latest News
            </div>
            <h2 class="text-4xl font-bold text-blue-900 mb-4">Community Updates</h2>
            <p class="text-xl text-blue-700 max-w-2xl mx-auto">
                Stay informed with the latest announcements and community news.
            </p>
        </div>

        <!-- Dynamic Announcements -->
        <div class="grid md:grid-cols-3 gap-8 news-grid">
            @forelse ($announce as $item)
                <div class="bg-white rounded-xl shadow-lg transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-xl">
                    <!-- Image (if available) -->
                    @if ($item->attachment)
                        <img src="{{ asset('public/storage/' . $item->attachment) }}" alt="{{ $item->title }}" class="w-full h-50 object-cover rounded-t-xl">
                    @endif

                    <div class="p-6">
                        <!-- Category -->
                        <div class="inline-flex items-center rounded-full px-2 py-1 mb-4 text-xs font-semibold bg-blue-100 text-blue-800">
                            {{ $item->category ?? 'Announcement' }}
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2">
                            {{ $item->title }}
                        </h3>

                        <!-- Date -->
                        <p class="text-gray-500 text-sm mb-2">
                            {{ $item->publish_date ? $item->publish_date->format('M d, Y') : $item->created_at->format('M d, Y') }}
                        </p>

                        <!-- Content preview -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($item->content), 100, '...') }}
                        </p>

                        <!-- Read More -->
                        <a href="{{ route('ShowAnnounce', $item->id) }}"
                           class="text-blue-600 font-semibold flex items-center transition-all duration-300 hover:text-blue-700">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                 class="w-4 h-4 ml-2">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 bg-white shadow-md rounded-xl py-10">
                    No announcements available.
                </div>
            @endforelse
        </div>
    </div>
</section>



  <section id="how-it-works" class="py-20 bg-gradient-to-r from-blue-50 to-sky-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-blue-900 mb-4">How It Works</h2>
                <p class="text-xl text-blue-700 max-w-2xl mx-auto">
                    Simple, fast, and efficient. Get your documents in just three easy steps.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">

     
                <div class="text-center p-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full step-number-bg text-white text-2xl font-bold mb-4">
                        1
                    </div>
                    <div class="flex items-center justify-center space-x-2 mb-4">
                        <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-200 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Choose Service</h3>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Select the document or service you need from our comprehensive list.
                    </p>
                </div>


                <div class="text-center p-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full step-number-bg text-white text-2xl font-bold mb-4">
                        2
                    </div>
                    <div class="flex items-center justify-center space-x-2 mb-4">
                        <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-200 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><line x1="10" y1="9" x2="8" y2="9"></line></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Submit & Track</h3>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Fill out the form, upload requirements, and track your application in real-time.
                    </p>
                </div>

         
                <div class="text-center p-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full step-number-bg text-white text-2xl font-bold mb-4">
                        3
                    </div>
                    <div class="flex items-center justify-center space-x-2 mb-4">
                        <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-200 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M22 11.08V12a10 10 0 1 1-5.93-8.5"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Receive Document</h3>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Get notified when ready and download your document or schedule pickup.
                    </p>
                </div>

            </div>

            <div class="text-center mt-12">
                <a href="{{ route('Services') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-300">
                    View All Services
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-3 w-5 h-5">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>


<section id='faq' class="py-20 bg-white ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-blue-900 mb-4 text-center" >Frequently Asked Questions</h2>
        
        <div class="mt-8 space-y-6">

            <div class="collapse collapse-plus border bg-white border-gray-300 rounded-lg">
                <input type="checkbox" class="peer" />
                <div class="collapse-title text-lg font-medium text-gray-900 peer-checked:text-blue-600">
                     How do I register for an account on the e-services portal?
                </div>
                <div class="collapse-content text-gray-600">
                    <p>To register, simply click on the "Sign Up" button on the portal's homepage. Provide your full name, address, contact information, and create a secure password. You'll receive an email verification to activate your account.</p>
                </div>
            </div>
            

            <div class="collapse collapse-plus border bg-white border-gray-300 rounded-lg">
                <input type="checkbox" class="peer" />
                <div class="collapse-title text-lg font-medium text-gray-900 peer-checked:text-blue-600">
                    How long does it take to process a barangay clearance?
                </div>
                <div class="collapse-content text-gray-600">
                    <p>Barangay clearance typically takes 1-7 working days to process after submitting all required documents.</p>
                </div>
            </div>


            <div class="collapse collapse-plus border bg-white border-gray-300 rounded-lg">
                <input type="checkbox" class="peer" />
                <div class="collapse-title text-lg font-medium text-gray-900 peer-checked:text-blue-600">
                    Can I pay the service fees online?
                </div>
                <div class="collapse-content text-gray-600">
                    <p>No, you can only pay at the office. After making the payment, you will receive the requested documents.</p>
                </div>
            </div>

   
            <div class="collapse collapse-plus border bg-white border-gray-300 rounded-lg">
                <input type="checkbox" class="peer" />
                <div class="collapse-title text-lg font-medium text-gray-900 peer-checked:text-blue-600">
                    How can I contact customer support?
                </div>
                <div class="collapse-content text-gray-600">
                    <p>You can reach customer support through our contact page or by emailing support@ourwebsite.com. We are available 24/7 to assist you.</p>
                </div>
            </div>
        </div>
    </div>
</section>


</x-layout>
<script>
  gsap.registerPlugin(ScrollTrigger);

  const scrollTriggerSettings = {
    start: "top 80%",
    end: "bottom 20%",
    toggleActions: "play none none none",
    
  };
  gsap.from(".hero-title", {
    opacity: 0,
    x: -150,
    duration: 1,
    ease: "power2.out",
    scrollTrigger: {
      trigger: ".hero-section",
      ...scrollTriggerSettings
    }
  });
  // const text = "E-Services";
  // const target = document.getElementById("e-services");

  // function typeLoop() {
  //   target.textContent = ""; // Reset text each loop

  //   const tl = gsap.timeline({
  //     onComplete: () => {
  //       gsap.delayedCall(2, typeLoop); // Restart after delay
  //     }
  //   });

  //   // Loop through characters with staggered delay
  //   text.split("").forEach((char, i) => {
  //     tl.to({}, { // dummy tween for timing
  //       duration: 0.15, // typing speed
  //       onComplete: () => {
  //         target.textContent += char;
  //       }
  //     });
  //   });
  // }

  // typeLoop();

  gsap.from(".hero-subtitle", {
    opacity: 0,
    y: 50,
    duration: 1,
    delay: 0.3,
    ease: "power2.out",
    scrollTrigger: {
      trigger: ".hero-section",
      ...scrollTriggerSettings
    }
  });

  gsap.from(".button-left", {
    opacity: 0,
    x: -100,
    duration: 0.5,
    delay: 0.3,
    ease: "power2.out",
    scrollTrigger: {
      trigger: ".hero-section",
      ...scrollTriggerSettings
    }
  });

  gsap.from(".button-right", {
    opacity: 0,
    x: 100,
    duration: 0.5,
    delay: 0.3,
    ease: "power2.out",
    scrollTrigger: {
      trigger: ".hero-section",
      ...scrollTriggerSettings
    }
  });

  gsap.from(".hero-features div", {
    opacity: 0,
    y: 20,
    duration: 0.8,
    delay: 0.9,
    stagger: 0.2,
    ease: "power2.out",
    scrollTrigger: {
      trigger: ".hero-features",
      ...scrollTriggerSettings
    }
  });

  document.querySelectorAll(".news-grid > div").forEach((card, i) => {
    gsap.from(card, {
      opacity: 0,
      y: 50,
      duration: 0.3,
      ease: "power3.out",
      scrollTrigger: {
        trigger: card,
        start: "top 85%",      
        toggleActions: "play none none none",
            
      },
      delay: i * 0.2           
    });
  });


  gsap.from("#how-it-works h2, #how-it-works p", {
    opacity: 0,
    y: 50,
    duration: 0.8,
    stagger: 0.2,
    scrollTrigger: {
      trigger: "#how-it-works",
      ...scrollTriggerSettings
    }
  });

  gsap.from("#how-it-works .grid > div", {
    opacity: 0,
    y: 50,
    duration: 1,
    stagger: 0.3,
    ease: "power2.out",
    scrollTrigger: {
      trigger: "#how-it-works .grid",
      ...scrollTriggerSettings
    }
  });


  gsap.from("#faq h2", {
    opacity: 0,
    y: 20,
    duration: 0.8,
    scrollTrigger: {
      trigger: "#faq",
      ...scrollTriggerSettings
    }
  });

  gsap.from("#faq .collapse", {
    opacity: 0,
    y: 30,
    duration: 0.8,
    stagger: 0.2,
    ease: "power2.out",
    scrollTrigger: {
      trigger: "#faq .collapse",
      ...scrollTriggerSettings
    }
  });

const backToTop = document.getElementById("backToTop");

window.addEventListener("scroll", () => {
  if (window.scrollY > 100) {
    backToTop.classList.remove("hidden");
  } else {
    backToTop.classList.add("hidden");
  }
});

backToTop.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});

</script>
<script>
var app = document.getElementById('e-services');

var typewriter = new Typewriter(app, {
    loop: true,
    cursor: '_' 
});

typewriter.typeString('E-Services')
    .pauseFor(2000)
    .deleteAll()
    .start();
</script>


@if(session('success'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        iconColor: '#ffffff',
        background: '#22c55e', 
        color: '#ffffff'
    });
</script>
@endif
