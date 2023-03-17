<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Welcome to Literary Hub</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">an online community for book lovers.</p>
                <a href="/groups" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Get started
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="./build/assets/books.png" alt="mockup">
            </div>                
        </div>
    </section>

  <div class="py-5 flex justify-center flex-wrap">
    <div class="pt-5 w-full flex justify-center">
        <p class="max-w-2xl mb-6 font-bold text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Your favourite Books</p>
    </div>
    @if($books->count())
        
        @foreach($books as $key => $book)
        @if (isset($book->favourites))
          @foreach($book->favourites as $key => $user)
          <?php 
              if($user->id == Auth::user()->id){
                $pass = 1;
              }
          ?>
          @endforeach
            @if ($pass == 1)
    <div
    class="mx-3 my-2 flex flex-col rounded-lg bg-white shadow-lg dark:bg-neutral-700 md:max-w-xl md:flex-row transform transition duration-500 hover:scale-105 hover:shadow-2xl">
      <img
        class="h-96 w-full rounded-t-lg object-cover md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
        src="{{ $book->book_cover }}"
        alt="" />
      <div class="flex flex-col justify-start p-6">
        <div class="w-20 flex flex-col items-baseline">
          <div>
            <form method="post" action="{{ route('favourites.destroy' , [$book->id]) }}">
                @csrf
                @method('delete')
                    <button type="submit">
                        <abbr title="click to remove from favourites"><img width="33px" src="build/assets/heart_full.png" alt="heart"></abbr>
                    </button>
                </form>
          </div>
        <h5
          class="mb-2 text-xl font-medium text-neutral-800 dark:text-neutral-50">
          {{ $book->book_title }}
        </h5>
        </div>
        <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
          {{ $book->book_description }}
        </p>
        <p class="text-xs text-neutral-500 dark:text-neutral-300">
          {{ $book->book_author }}
        </p>
        @if (isset($book->rating))
        <?php $pass1 = -1; $rat=0; $val = 0?>
          @for ($i=0 ; $i < count($book->rating) ; $i++)
          <?php $rat += $book->rating[$i]->star_rating ?>
            @if ($book->rating[$i]->user_id == Auth::user()->id)
              <?php $pass1 = $i; ?>
            @endif
            <?php $val = $i ?>
          @endfor
        @endif
            
                   @if($pass1 != -1)
                                <div class="container">
                                    <div class="row">
                                       <div class="col mt-4">
                                             <p class="font-weight-bold ">Review</p>
                                             <div class="form-group row">
                                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                <div class="col">
                                                   <div class="rated">
                                                    @if ($rat==1)
                                                      <?php $rat=2; $val++ ?>
                                                    @endif
                                                    <?php $val++;?>
                                                    @for($i=1; $i<=floor($rat/($val)); $i++)
                                                      <input type="radio" id="star{{$i}}" class="rate" name="rating" value="5"/>
                                                      <label class="star-rating-complete" title="text">{{$i}} stars</label>
                                                    @endfor
                                                    </div>
                                                </div>
                                              </div>
                                       </div>
                                    </div>
                                 </div>
                      @elseif (!empty($book->rating[0]))
                          <div class="container">
                            <div class="row">
                               <div class="col mt-4">
                                     <p class="font-weight-bold ">Review</p>
                                     <div class="form-group row">
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <div class="col">
                                           <div class="rated">
                                            @for($i=1; $i<=floor($rat/($val+1)); $i++)
                                              <input type="radio" id="star{{$i}}" class="rate" name="rating" value="5"/>
                                              <label class="star-rating-complete" title="text">{{$i}} stars</label>
                                            @endfor
                                            </div>
                                        </div>
                                      </div>
                               </div>
                            </div>
                         </div>
                                <div class="container">
                                    <div class="row">
                                       <div class="col mt-4">
                                          <form method="POST" id="{{ $book->id }}" class="py-2 px-4" action="{{route('rating.store')}}" style="box-shadow: 0 0 10px 0 #ddd;" autocomplete="off">
                                             @csrf
                                             @method('post')
                                             <p class="font-weight-bold ">Review</p>
                                             <div class="form-group row w-52">
                                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                <div class="col">
                                                   <div class="rate">
                                                      <input type="radio" id="star{{ $book->id }}5" class="rate" name="rating" value="5"/>
                                                      <label for="star{{ $book->id }}5" title="text">5 stars</label>
                                                      <input type="radio" checked id="star{{ $book->id }}4" class="rate" name="rating" value="4"/>
                                                      <label for="star{{ $book->id }}4" title="text">4 stars</label>
                                                      <input type="radio" id="star{{ $book->id }}3" class="rate" name="rating" value="3"/>
                                                      <label for="star{{ $book->id }}3" title="text">3 stars</label>
                                                      <input type="radio" id="star{{ $book->id }}2" class="rate" name="rating" value="2">
                                                      <label for="star{{ $book->id }}2" title="text">2 stars</label>
                                                      <input type="radio" id="star{{ $book->id }}1" class="rate" name="rating" value="1"/>
                                                      <label for="star{{ $book->id }}1" title="text">1 star</label>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="mt-3 text-right">
                                                <button class="btn btn-sm py-2 px-3 btn-info">Submit
                                                </button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                                 @else
                                 <div class="container">
                                  <div class="row">
                                     <div class="col mt-4">
                                        <form method="POST" id="{{ $book->id }}" class="py-2 px-4" action="{{route('rating.store')}}" style="box-shadow: 0 0 10px 0 #ddd;" autocomplete="off">
                                           @csrf
                                           @method('post')
                                           <p class="font-weight-bold ">Review</p>
                                           <div class="form-group row w-52">
                                              <input type="hidden" name="book_id" value="{{ $book->id }}">
                                              <div class="col">
                                                 <div class="rate">
                                                    <input type="radio" id="star{{ $book->id }}5" class="rate" name="rating" value="5"/>
                                                    <label for="star{{ $book->id }}5" title="text">5 stars</label>
                                                    <input type="radio" checked id="star{{ $book->id }}4" class="rate" name="rating" value="4"/>
                                                    <label for="star{{ $book->id }}4" title="text">4 stars</label>
                                                    <input type="radio" id="star{{ $book->id }}3" class="rate" name="rating" value="3"/>
                                                    <label for="star{{ $book->id }}3" title="text">3 stars</label>
                                                    <input type="radio" id="star{{ $book->id }}2" class="rate" name="rating" value="2">
                                                    <label for="star{{ $book->id }}2" title="text">2 stars</label>
                                                    <input type="radio" id="star{{ $book->id }}1" class="rate" name="rating" value="1"/>
                                                    <label for="star{{ $book->id }}1" title="text">1 star</label>
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="mt-3 text-right">
                                              <button class="btn btn-sm py-2 px-3 btn-info">Submit
                                              </button>
                                           </div>
                                        </form>
                                     </div>
                                  </div>
                               </div>
                          @endif
      </div>
    </div>
    @else
         <div class="flex justify-center items-center pt-20  mb-5">
            <h1 class="text-lg text-gray-600">You don't have any Favourite Books</h1>
         </div> 
    @endif      
    @endif
    <?php 
      $pass = 0;
    ?>
    @endforeach        
    @endif
  </div>
</x-app-layout>