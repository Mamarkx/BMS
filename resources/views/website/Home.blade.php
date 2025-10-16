
<button id="backToTop" 
    class="hidden fixed bottom-6 right-6 z-50 bg-blue-600 text-white p-4 cursor-pointer rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300">
    <i class="fa-solid fa-arrow-up h-5 w-6 text-xl"></i>
</button>

<x-layout>
 <section class="hero-section relative min-h-screen flex items-center justify-center pt-20 bg-cover bg-center" style="background-image: url('{{ asset('images/register.jpg') }}');">
  {{-- <div class="absolute inset-0 hero-overlay-left"></div>--}}
  {{-- <div class="absolute inset-0 hero-overlay-right"></div>  --}}
<div class="absolute inset-0 bg-black opacity-70 "></div>
  <div class="container mx-auto flex justify-between h-full px-4 md:px-6 relative z-10">
    <div class="text-center flex-1 lg:text-left space-y-8 text-white lg:text-blue-950">
      <div class="space-y-4"> 
        <h1 class="hero-title text-5xl lg:text-7xl font-bold leading-tight">
          <span class="block text-white">Barangay</span>
          <span class="text-sky-300" id="e-services">E-Services</span>
        </h1>
      </div>
      <p class="hero-subtitle text-xl max-w-2xl leading-relaxed text-blue-100 lg:text-white">
Barangay e-Services is an online platform primarily established to provide residents with efficient access to essential barangay services. It is designed to streamline administrative processes, reduce waiting times, promote faster and more convenient transactions within the community.
      </p>
        {{-- <div class="hero-buttons flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
            <a href="{{ route('Services') }}" class="button-left bg-blue-400 hover:bg-blue-700 text-white px-8 py-4 text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center">
                View Services
                <svg class="ml-2 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M5 12h14m0 0l-6 6m6-6l-6-6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
            </a> 
           <a href="#track" class="button-right border-2 border-blue-400 text-blue-600 hover:bg-blue-600 hover:text-white px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 bg-transparent flex items-center">
                Track Request
            </a>
        </div> --}}
      {{-- <div class="hero-features grid grid-cols-3 gap-2 max-w-md mx-auto lg:mx-0">
        <div class="text-center">
          <div class="w-14 h-14 bg-blue-900/50 lg:bg-white rounded-full flex items-center justify-center mx-auto mb-2 backdrop-blur-sm">
            <i class="fa-regular fa-clock w-6 h-6 text-blue-200 lg:text-black text-2xl"></i>
          </div>
          <p class="text-sm font-medium text-blue-100 lg:text-white">24/7 Access</p>
        </div>
        <div class="text-center">
          <div class="w-14 h-14 bg-blue-900/50 lg:bg-white rounded-full flex items-center justify-center mx-auto mb-2 backdrop-blur-sm">
            <i class="fa-solid fa-shield-halved w-6 h-6 text-black lg:text-black text-2xl"></i>
          </div>
          <p class="text-sm font-medium text-blue-100 lg:text-white">Secure</p>
        </div>
        <div class="text-center">
          <div class="w-14 h-14 bg-blue-900/50 lg:bg-white rounded-full flex items-center justify-center mx-auto mb-2 backdrop-blur-sm">
           <i class="fa-solid fa-bolt w-6 h-6 text-blue-200 lg:text-black text-2xl"></i>
          </div>
          <p class="text-sm font-medium text-blue-100 lg:text-white">Fast</p>
        </div>
      </div> --}}
    </div>
<style>
.slider{
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
}
.item {
    position: absolute;
    width: 370px;
    height: 350px;
    text-align: justify;
    background-color: rgba(255, 255, 255, 0.973); 
    border-radius: 10px;
    transition: 0.5s;
    left: calc(50% - 185px); 
    top: 0;
    backdrop-filter: blur(8px); 
    color: #fff; 
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}
.item:hover {
    transform: scale(1.05); 
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); 
}
#next, #prev{
    position: absolute;
    top: 40%;
    color: #fff;
    background-color: white;
    border: none;
    font-size: xxx-large;
    font-family: monospace;
    font-weight: bold;
    left: 400px;
}
#next{
    left: unset;
    right: 400px;
}
</style>
 <div class="slider flex-1 h-screen  justify-center items-center hidden md:flex py-10">
  <div class="swiper-container w-full max-w-7xl relative">
<div class="swiper-wrapper">

    <div class="swiper-slide item group flex flex-col bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="h-2 bg-blue-500 p-5"></div>
        <div class="p-8 flex flex-col justify-center items-center text-center  bg-blue-100">
            <div class="flex items-center justify-center w-20 h-20 rounded-full border-2 border-gray-700 mb-6 bg-white">
                <i class="fas fa-hand-holding-usd text-4xl text-gray-700"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-0">Indigency Certificate</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Issued to residents below the poverty threshold for financial assistance or government support.</p>
        </div>
        <div class="h-2 bg-blue-500 p-6"></div>
    </div>

    <div class="swiper-slide item group flex flex-col bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="h-2 bg-blue-500 p-5"></div>
        <div class="p-8 flex flex-col justify-center items-center text-center flex-1 bg-blue-100">
            <div class="flex items-center justify-center w-20 h-20 rounded-full border-2 border-gray-700 mb-6 bg-white">
                <i class="fas fa-home text-4xl text-gray-700"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-0">Residency Certificate</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Certifies residence within the Barangay for legal purposes such as enrollment or employment.</p>
        </div>
        <div class="h-2 bg-blue-500 p-6"></div>
    </div>

    <div class="swiper-slide item group flex flex-col bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="h-2 bg-blue-500 p-5"></div>
        <div class="p-8 flex flex-col justify-center items-center text-center flex-1 bg-blue-100">
            <div class="flex items-center justify-center w-20 h-20 rounded-full border-2 border-gray-700 mb-6 bg-white">
                <i class="fas fa-user-check text-4xl text-gray-700"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-0">First Time Job Seeker</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Issued to individuals seeking employment for the first time to avail benefits under government programs.</p>
        </div>
        <div class="h-2 bg-blue-500 p-6"></div>
    </div>

    <div class="swiper-slide item group flex flex-col bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="h-2 bg-blue-500 p-5"></div>
        <div class="p-9 flex flex-col justify-center items-center text-center flex-1 bg-blue-100">
            <div class="flex items-center justify-center w-20 h-20 rounded-full border-2 border-gray-700 mb-6 bg-white">
                <i class="fas fa-id-card text-4xl text-gray-700"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-0">Cedula</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Proof of payment for community tax, required for various transactions in the Philippines.</p>
        </div>
        <div class="h-2 bg-blue-500 p-6"></div>
    </div>

    <div class="swiper-slide item group flex flex-col bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="h-2 bg-blue-500 p-5"></div>
        <div class="p-8 flex flex-col justify-center items-center text-center flex-1 bg-blue-100">
            <div class="flex items-center justify-center w-20 h-20 rounded-full border-2 border-gray-700 mb-6 bg-white">
                <i class="fas fa-id-badge text-4xl text-gray-700"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-0">Barangay ID Form</h3>
            <p class="text-gray-600 text-sm leading-relaxed">A valid identification card issued to residents of the Barangay, used for official purposes within the community.</p>
        </div>
        <div class="h-2 bg-blue-500 p-6"></div>
    </div>

    <div class="swiper-slide item group flex flex-col bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="h-2 bg-blue-500 p-4"></div>
        <div class="p-8 flex flex-col justify-center items-center text-center  bg-blue-100">
            <div class="flex items-center justify-center w-20 h-20 rounded-full border-2 border-gray-700 mb-6 bg-white">
                <i class="fas fa-business-time text-4xl text-gray-700"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-0">Business Permit</h3>
            <p class="text-gray-600 text-sm leading-relaxed">Certifies that a business is legally registered and authorized to operate within the Barangay, ensuring compliance with local regulations.</p>
        </div>
        <div class="h-2 bg-blue-500 p-6"></div>
    </div>

</div>
    <!-- Pagination and Navigation -->
    <div  id="next"></div>
    <div  id="prev"></div>
  </div>
</div>

  </div>

  
</section>

<section id="news-section" class="py-20 bg-white ">
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


        <div class="grid md:grid-cols-3 gap-8 news-grid">
         
            <div class="bg-white rounded-xl shadow-lg transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-xl">
                <div class="p-6">
                    <div class="inline-flex items-center rounded-full px-2 py-1 mb-4 text-xs font-semibold bg-blue-100 text-blue-800">
                        Advisory
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Scheduled Water Interruption Notice</h3>
                    <p class="text-gray-500 text-sm mb-2">Aug 22, 2025</p>
                    <p class="text-gray-600 text-sm mb-4">Maintenance will affect Zones 1-3 from 9:00 AM to 3:00 PM. Please store enough water.</p>
                    <a href="#" class="text-blue-600 font-semibold flex items-center transition-all duration-300 hover:text-blue-700">
                        Read More
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>

   
            <div class="bg-white rounded-xl shadow-lg transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-xl">
                <div class="p-6">
                    <div class="inline-flex items-center rounded-full px-2 py-1 mb-4 text-xs font-semibold bg-green-100 text-green-800">
                        Community
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Barangay Clean-up Drive</h3>
                    <p class="text-gray-500 text-sm mb-2">Sep 02, 2025</p>
                    <p class="text-gray-600 text-sm mb-4">Join our community clean-up. Volunteers will receive certificates of participation.</p>
                    <a href="#" class="text-blue-600 font-semibold flex items-center transition-all duration-300 hover:text-blue-700">
                        Read More
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-xl">
                <div class="p-6">
                    <div class="inline-flex items-center rounded-full px-2 py-1 mb-4 text-xs font-semibold bg-purple-100 text-purple-800">
                        Update
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Digital Services Rollout</h3>
                    <p class="text-gray-500 text-sm mb-2">Aug 30, 2025</p>
                    <p class="text-gray-600 text-sm mb-4">New e-services added for faster, paperless transactions and better transparency.</p>
                    <a href="#" class="text-blue-600 font-semibold flex items-center transition-all duration-300 hover:text-blue-700">
                        Read More
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
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
<script>
let items = document.querySelectorAll('.slider .item');
let next = document.getElementById('next');
let prev = document.getElementById('prev');

let active = 3; // Start at center
let total = items.length;

function loadShow() {
    let stt = 0;
    items.forEach((item, i) => {
        item.style.transition = '0.5s';
        item.style.opacity = '0';
        item.style.zIndex = '-1';
        item.style.transform = 'scale(0.8)';
    });

    items[active].style.transform = `none`;
    items[active].style.zIndex = 1;

    items[active].style.filter = 'none';
    items[active].style.opacity = 1;

    stt = 0;
    for (let i = 1; i <= 3; i++) {
        let nextIndex = (active + i) % total;
        stt++;
        items[nextIndex].style.transform = `translateX(${120 * stt}px) scale(${1 - 0.2 * stt}) perspective(16px) rotateY(-1deg)`;
        items[nextIndex].style.zIndex = -stt;
        items[nextIndex].style.opacity = stt > 2 ? 0 : 0.6;
    }

    stt = 0;
    for (let i = 1; i <= 3; i++) {
        let prevIndex = (active - i + total) % total;
        stt++;
        items[prevIndex].style.transform = `translateX(${-120 * stt}px) scale(${1 - 0.2 * stt}) perspective(16px) rotateY(1deg)`;
        items[prevIndex].style.zIndex = -stt;
        items[prevIndex].style.opacity = stt > 2 ? 0 : 0.6;
    }
}

next.onclick = () => {
    active = (active + 1) % total;
    loadShow();
};

prev.onclick = () => {
    active = (active - 1 + total) % total;
    loadShow();
};

// Auto-slide every 4 seconds
setInterval(() => {
    active = (active + 1) % total;
    loadShow();
}, 2000);

loadShow();
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
