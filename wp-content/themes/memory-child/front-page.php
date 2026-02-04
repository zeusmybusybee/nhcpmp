<?php
get_header(); 

?>
<style>
  .collections-grid .card img {
    position: absolute;
    top: -12px;
    left: 7%;
    background-size: cover;
    width: 100%;
     filter: brightness(0) invert(1);
    height: auto;
    max-width: 70px;
}
  h2 {
  font-size: 38px; /* 1.875rem */
}
.collection-card h2 {
  margin-bottom: 10px;
  color: #fff;
  font-weight: 300;
}
.collection-card:hover h2{
  font-weight:700;
}
.hero h1 {
  line-height: 1.3;
  color: var(--brown);
  margin-bottom: 1rem;
  margin-top: 0;
}
.search-box button {
    padding: 0 1rem;
    background: var(--brown);
    color: #fff;
    border: none;
    font-size: 20px;
    cursor: pointer;
    width: 16%;
    text-align: center;
    font-weight: 600;
}
.search-box input[type="text"]::placeholder {
    font-size: 18px;
}
.search-box {
    display: flex;
    border: 1px solid var(--brown);
    border-radius: 4px;
    overflow: hidden;
    width: 80%;
    margin: auto;
}
.search-box input {
  flex: 1;
    padding: 2rem;
    border: none;
    font-size: 0.9rem;
}

    .hero {
        padding: 14rem 2rem;
    }
.collection-card .btn {
  margin-top: 15px;
    padding: 0 40px 10px;
    color: #fff;
    text-decoration: none;
    background: #ffffff33;
    width: fit-content;
    font-size: 32px;
    border-radius: 0;
    font-weight: 400;
    text-transform: none;
     /* NEW */
  opacity: 0;
  transform: translateY(10px);
  transition: opacity 0.3s ease, transform 0.3s ease;
}
.collection-card::before {
background: linear-gradient(to bottom, rgba(50, 30, 10, 0.8), rgba(50, 30, 10, 0.3));
}
.collection-card:hover::after {
    content: '';
    background: linear-gradient(to bottom, rgb(8 8 8), rgb(50 30 10 / 14%));
    width: 100%;
    height: 100vh;
    position: absolute;
    left: 0;
}
.card::before {
       content: "";
    height: 50px;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
}
.card {
    background: #f2f2f2;
    border-radius: 8px;
    padding: 8rem 3rem 1rem;
    position: relative;
    overflow: hidden;
}
/* title color */
.featured-collections .navy h3 { color: #2c2f6c !important;  }
.red h3 { color: #c7373f !important; }
.purple h3 { color: #8e2f8f !important; }
.green h3{ color: #4f7f3f !important; }
.teal h3 { color: #1fa3a3 !important; }
.orange h3 { color: #d87434 !important; }
.darkgreen h3 { color: #0f5c2e !important; }
.gold h3 { color: #c7ad2a !important; }
</style>
<div id="primary" >


    <div id="content" class="site-content">

<section class="hero">
  <div class="hero-inner">
    <div class="hero-icon">
      <!-- simple zigzag icon -->
      <svg width="48" height="32" viewBox="0 0 48 32" fill="none">
        <path d="M0 16L8 8L16 16L24 8L32 16L40 8L48 16"
              stroke="#7A4F1D" stroke-width="3" fill="none"/>
      </svg>
    </div>

    <h1>We envision to democratize Philippine History Materials</h1>

    <p>
      Since 2020, the NHCP has allotted a budget for the continuous development
      of an online platform that can hold a great number of high-resolution
      digitized materials concerning Philippine national and local history.
    </p>

    <form class="search-box">
      <input
        type="text"
        placeholder="Search the National Memory Project"
      />
      <button type="submit">Search</button>
    </form>
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
  <h2>Featured Collections</h2>

  <div class="collections-grid">
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