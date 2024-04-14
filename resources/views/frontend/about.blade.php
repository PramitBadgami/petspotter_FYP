@extends('frontend.layouts.app')

@section('content')

<style>
 img{
    width: 100%!important;
    height: 20%!importtant;
 }

 .gallery {
  display: flex;
  /*border: 1px solid black;*/
  width: 88%;
  height: 50vh;
}

.left, .right {
  width: 50%;
  display: flex;
  overflow: hidden;
}

.left {
  & .inner { perspective-origin: right center; }
  & .item {
    right : -10rem;

    &:item:nth-child(1) { transform: translate3d(-10rem,0,-4rem); }
    &:item:nth-child(2) { transform: translate3d(-20rem,0,-8rem); }
    &:item:nth-child(3) { transform: translate3d(-30rem,0,-12rem); }
    &:item:nth-child(4) { transform: translate3d(-40rem,0,-16rem); }
    &:item:nth-child(5) { transform: translate3d(10rem,0,-4rem); }
  }
}

.right {
  & .inner { perspective-origin: left center; }
  & .item {
    left : -10rem;

    &:item:nth-child(1) { transform: translate3d(10rem,0,-4rem); }
    &:item:nth-child(2) { transform: translate3d(20rem,0,-8rem); }
    &:item:nth-child(3) { transform: translate3d(30rem,0,-12rem); }
    &:item:nth-child(4) { transform: translate3d(40rem,0,-16rem); }
    &:item:nth-child(5) { transform: translate3d(-10rem,0,-4rem); }
  }
}

.inner {
  position: relative;
  width: 100%;
  display: flex;
  align-items: center;
  perspective: 500px;
  transform-style: preserve-3d;
}

.item {
  position: absolute;
  width: 12rem;
  height: 14rem;
  border: 5px solid black;
  background-color: white;
  object-fit: cover;
  transition: transform 0.3s cubic-bezier(0, 0.55, 0.45, 1);
}

/* Media query for smaller screens */
@media (max-width: 768px) {
  .left,
  .right {
    width: 100%;
  }

  .left .inner,
  .right .inner {
    perspective-origin: center;
  }

  .left .item,
  .right .item {
    width: 100%;
  }
}

/* Additional media queries for smaller screens */
@media (max-width: 480px) {
  .left .item,
  .right .item {
    height: 10rem;
  }
}
</style>


    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item">About Us</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
    <!-- <section= class="section-3 mt-5"> -->
        <div class="container">
            <h1 class="my-3">About Us</h1><br>
            <img src="{{ asset('front-assets/images/doglove.jpg') }}" alt=""><br><br><br>

          

            <p>Welcome to our pet adoption and pet products website! At PetSpotter, we are passionate about connecting loving families with their perfect furry companions while also providing everything they need to care for their pets.</p>

            <p>Our journey began with a simple mission: to create a platform where pet lovers could find their ideal pets easily, ethically, and conveniently. We understand the joy and fulfillment that comes from adopting a pet, and we are committed to making this process as seamless and rewarding as possible.</p>

            <p>When you choose to adopt a pet through PetSpotter, you're not just welcoming a new member into your family; you're also giving a deserving animal a second chance at happiness. Our platform features a diverse range of pets, including dogs, cats, rabbits, birds, and more, all of whom are eagerly awaiting their forever homes. Each pet has a detailed profile, allowing you to learn about their personality, habits, and unique traits, so you can find the perfect match for your lifestyle and preferences.</p>

            <p>But our commitment to pets doesn't end with adoption. We also offer a wide selection of high-quality pet products to ensure that your furry friends live happy, healthy lives. From nutritious food and tasty treats to cozy beds, stimulating toys, and essential grooming supplies, we have everything you need to keep your pets well-cared for and content.</p>

            <div class='gallery'>
            <div class='left'>
              <div class='inner'>
                <img class='item' src="{{ asset('front-assets/images/pet-carousel-3.jpg') }}" data-counter='1'>
                <img class='item' src="{{ asset('front-assets/images/pet-carousel-1.jpg') }}" data-counter='2'>
                <img class='item' src="{{ asset('front-assets/images/download.jpg') }}" data-counter='3'>
              </div>
            </div>
            <div class='right'>
              <div class='inner'>
                <img class='item' src="{{ asset('front-assets/images/pet-carousel-1.jpg') }}" data-counter='1'>
                <img class='item' src="{{ asset('front-assets/images/download.jpg') }}" data-counter='2'>
                <img class='item' src="{{ asset('front-assets/images/doglove.jpg') }}" data-counter='3'>
              </div>
            </div>
          </div>

            <p>At PetSpotter, we believe that every pet deserves to be treated with love, kindness, and respect. That's why we work closely with reputable animal shelters, rescue organizations, and responsible breeders to ensure that all pets listed on our platform are ethically sourced and cared for. We also promote responsible pet ownership and provide valuable resources and advice to help pet parents navigate the joys and challenges of pet ownership.</p>

            <p>Whether you're looking to adopt a new pet or stock up on supplies for your furry friends, PetSpotter is here to support you every step of the way. Join us in our mission to create a world where every pet is loved, cherished, and given the chance to thrive. Thank you for choosing PetSpotter as your trusted partner in pet adoption and care.</p>

        </div>
    </section>

@endsection

@section('customJs')
<script>

    const leftItems = document.querySelectorAll(".left .item");
    const rightItems = document.querySelectorAll(".right .item");
    const limit = leftItems.length;

    const leftCoordinates = [
      { x: -10, z: -4 },
      { x: -20, z: -8 },
      { x: -30, z: -12 },
      { x: -40, z: -16 },
      { x: 10, z: -4 }
    ];

    const rightCoordinates = [
      { x: 10, z: -4 },
      { x: 20, z: -8 },
      { x: 30, z: -12 },
      { x: 40, z: -16 },
      { x: -10, z: -4 }
    ];

    const itemPos = (item,{x,z}) => item.style.transform = `translate3d(${x}rem,0,${z}rem)`;

    function animateItems(item,coordinates) {
      const count = Number(item.dataset.counter);
      itemPos(item,coordinates[count-1]);
      item.dataset.counter = `${count === limit ? 1 : count + 1}`;
    }

    function activate() {
      setInterval(() => {
        for (let i = 0; i < limit; i++) {
          animateItems(leftItems[i],leftCoordinates);
          animateItems(rightItems[i],rightCoordinates);
        }
      },2000);
    };

    window.addEventListener('load',activate,false);

</script>
@endsection