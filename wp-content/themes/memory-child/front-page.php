<?php
get_header(); 

?>
<style>

.hero {
    padding: 7rem 2rem 13rem;
}
section.hero h1 {
    color: #6b4a1e;
    font-weight: 400 !important;
    font-size: 48px;
}
.hero-search {
  max-width: 900px;
  border: 1px solid #c9b9a6;
  border-radius: 6px;
  overflow: hidden;
}
section.hero img {
    width: 100%;
    height: auto;
    max-width: 159px;
     filter: sepia(100%) saturate(300%) brightness(70%) hue-rotate(-15deg);
}
.hero-search .hero-input {
  flex: 1;
  border: none;
  padding: 18px 24px;
  font-size: 18px;
  outline: none;
  color: #555;
  padding: 16px 10px 14px;
}

.hero-input::placeholder {
  color: #bfbfbf;
  font-style: italic;
}

form.hero-search .hero-btn {
  background-color: #6b4a1e; /* brown */
  color: #fff;
  border: none;
  padding: 0 32px;
  font-size: 18px;
  font-weight: 600;
  cursor: pointer;
}

.hero-btn:hover {
  background-color: #5a3e18;
}


.scroll-wrapper {
    background: #f8f9fa;
    position: absolute;
       bottom: -108px;
    left: 50%;
    transform: translateX(-50%);
}

.arrow-hover {
  position: relative;
  cursor: pointer;
  color: #dc3545;
}

.scroll-text {
  position: absolute;
  bottom: 75%;          /* nasa taas ng arrow */
  left: 50%;
  transform: translateX(-50%) translateY(5px);
  opacity: 0;
  font-size: 14px;
  white-space: nowrap;
  transition: opacity 0.3s ease, transform 0.3s ease;
  font-size: 18px;
    font-weight: 400;
}

/* hover sa arrow */
.arrow-hover:hover .scroll-text {
  opacity: 1;
  transform: translateX(-50%) translateY(-5px);
}

.scroll-wrapper i.fa-solid {
    font-size: 60px;
    color: #6b4a1e;
}

/* featured collection */
.card {
    background: #f2f2f2;
    border-radius: 8px;
    padding: 7rem 3rem 2rem;
    position: relative;
    overflow: hidden;
}
.card::before {
    content: "";
    height: 50px;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
}
.collections-grid img {
    width: 100%;
    margin: auto;
    max-width: 62px;
    position: absolute;
    top: -10px;
    filter: brightness(0) invert(1);
}

.featured-collections {
    /* padding: 1.5rem 1rem; */
    padding: 10rem 2rem;
}
section.featured-collections h2 {
    margin-bottom: 50px;
}
</style>
<div id="primary" >


    <div id="content" class="site-content">

<section class="hero">
  <div class="container-fluid">
    <div class="row justify-content-center text-center">
      <div class="col-lg-8">

        <div class="mb-3">
           <img src="http://localhost/nhcpmp/wp-content/uploads/2026/02/about-1.png" alt="">
        </div>

        <h1 class="mb-3 mt-0 fw-medium text-brown">
          We envision to democratize Philippine History Materials
        </h1>

        <p class="mb-4 text-muted mt-5 w-75 m-auto">
          Since 2020, the NHCP has allotted a budget for the continuous development
          of an online platform that can hold a great number of high-resolution
          digitized materials concerning Philippine national and local history.
        </p>

        <form class="hero-search d-flex mx-auto mt-5">
          <input
            type="text"
            class="hero-input"
            placeholder="Search the National Memory Project"
          >
          <button type="submit" class="hero-btn">
            Search
          </button>
        </form>

        <div class="container mt-5">
        <div class="scroll-wrapper d-flex align-items-center justify-content-center">

          <div class="arrow-hover">
            <div class="scroll-text">Scroll down</div>
           <i class="fa-solid fa-caret-down"></i>
          </div>

        </div>
      </div>


        <!-- arrow -->
      </div>
    </div>
  </div>
</section>



<section class="collections">

  <div class="collection-card books">
    <div>
    <h2>Books</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
     <a href="#" class="btn">Explore</a>
    </div>
  </div>

  <div class="collection-card artifacts">
    <div>
    <h2>Artifacts</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    <a href="#" class="btn">Explore</a>
    </div>
  </div>

  <div class="collection-card heraldry">
    <div>
    <h2>Philippine Heraldry</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
     <a href="#" class="btn">Explore</a>
    </div>
  </div>

  <div class="collection-card sites">
    <div>
    <h2>Historic Sites and Structures</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
     <a href="#" class="btn">Explore</a>
    </div>
  </div>

  <div class="collection-card towns">
    <div>
    <h2>Foundation of Towns</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
     <a href="#" class="btn">Explore</a>
    </div>
  </div>

  <div class="collection-card av">
    <div>
        
    
    <h2>Audio-Visual Materials</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
     <a href="#" class="btn">Explore</a>
  </div>
  </div>

</section>


<section class="featured-collections">
    <div class="container">
  <h2 class="mt-0">Featured Collections</h2>

  <div class="collections-grid mt-5">
    <article class="card navy">
       <img src="http://localhost/nhcpmp/wp-content/uploads/2026/02/about-1.png" alt="">
      <h3>Local History</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </article>

    <article class="card red">
        <img src="http://localhost/nhcpmp/wp-content/uploads/2026/02/about-1.png" alt="">
      <h3>Philippine Revolution</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </article>

    <article class="card purple">
        <img src="http://localhost/nhcpmp/wp-content/uploads/2026/02/about-1.png" alt="">
      <h3>Women in Philippine History</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </article>

    <article class="card green">
        <img src="http://localhost/nhcpmp/wp-content/uploads/2026/02/about-1.png" alt="">
      <h3>Philippine Muslim History & Heritage</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </article>

    <article class="card teal">
        <img src="http://localhost/nhcpmp/wp-content/uploads/2026/02/about-1.png" alt="">
      <h3>NHCP Publications</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </article>

    <article class="card orange">
        <img src="http://localhost/nhcpmp/wp-content/uploads/2026/02/about-1.png" alt="">
      <h3>Journal of Philippine Local History & Heritage</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </article>

    <article class="card darkgreen">
        <img src="http://localhost/nhcpmp/wp-content/uploads/2026/02/about-1.png" alt="">
      <h3>Jose Rizal Collection</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </article>

    <article class="card gold">
        <img src="http://localhost/nhcpmp/wp-content/uploads/2026/02/about-1.png" alt="">
      <h3>Contributed Collections</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </article>
  </div>
  </div>
</section>


    </div>


</div><!-- #primary -->

<?php get_footer(); ?>