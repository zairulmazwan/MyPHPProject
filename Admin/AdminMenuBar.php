<style>

    /* For mobile phones: */
    @media only screen and (max-width: 780px) {
    [class*="col-"] {
        width: 100%;
    }
    }

    /* For desktop/bigger screen i.e ipad: */
    @media only screen and (min-width: 780px) {
    div.media {
        width: 33.33%;
    }
    }

    [class*="col-"] {
    float: left;
    padding: 15px;
    border: 1px solid red;
    }

    * {
    box-sizing: border-box;
    }

    .menuRow {
    background-color: rgb(110, 34, 133);
    color: white;
    text-align: center;
    }


    .col-1 {width: 8.33%;}
    .col-2 {width: 16.66%;}
    .col-3 {width: 25%;}
    .col-4 {width: 33.33%;}
    .col-5 {width: 41.66%;}
    .col-6 {width: 50%;}
    .col-7 {width: 58.33%;}
    .col-8 {width: 66.66%;}
    .col-9 {width: 75%;}
    .col-10 {width: 83.33%;}
    .col-11 {width: 91.66%;}
    .col-12 {width: 100%;}

    .row::after {
    content: "";
    clear: both;
    display: table;
}
</style>

<div>
    <div class="row col-3 menuRow">
      Student
    </div>
    <div class="row col-3 menuRow">
      Module
    </div>
    <div class="row col-3 menuRow">
     Parameter
    </div>
     <div class="row col-3 menuRow">
     User
    </div>
  </div>