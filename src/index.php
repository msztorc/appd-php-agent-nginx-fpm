<!-- EXAMPLE FILE TO GENERATE DUMMY LOAD - JUST FOR TESTING PURPOSE -->
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body>

<?php

    $width = 800;
    $height = 600;

    // collection_id => number of photos
    $collections = [
        '17098' =>  331, //flowers
        '181581' => 368, // animals
        '583479' => 154, //summer
        '2203755' => 142, //skyscrapers
        '136301' => 49 // space
    ];

    $collection = array_keys($collections)[rand(0, count($collections)-1)];
    $max_photos = $collections[$collection];


    $imgs = []; $urls = [];
    for($i=0; $i<10; $i++) {
        
        $img = rand(1, $max_photos);
        while(in_array($img, $imgs)) {
            $img = rand(1, $max_photos);
        }

        $imgs[] = $img;
        $urls[] = 'https://source.unsplash.com/collection/'. $collection .'/'. $width .'x'. $height .'/?sig='. $img;
    }


    //https://source.unsplash.com/collection/${collectionID}/${imageWidth}x${imageHeight}/?sig=${randomNumber}

?>

<div class="min-h-screen flex justify-center items-center dark:bg-slate-900">
    
    <div x-data="gallery()">
        <div class="mt-6 max-w-2xl mx-auto grid gap-2 grid-cols-4 grid-rows-5 px-6">
            <?php $img = $urls[0] ?>
            <a x-on:click.prevent="open" class="block relative bg-red-100 w-full h-24" href="<?= $img ?>">
                <img class="absolute inset-0 w-full h-full object-cover object-center" 
                     src="<?= $img ?>">
            </a>
            
            <?php $img = $urls[1] ?>
            <a x-on:click.prevent="open" class="block relative bg-red-100 row-span-2" href="<?= $img ?>">
                <img class="absolute inset-0 w-full h-full object-cover object-center" 
                     src="<?= $img ?>">
            </a>
            
            <?php $img = $urls[2] ?>
            <a x-on:click.prevent="open" class="block relative bg-red-100 col-span-2 row-span-2" href="<?= $img ?>">
                <img class="absolute inset-0 w-full h-full object-cover object-center" 
                     src="<?= $img ?>">
            </a>
            
            <?php $img = $urls[3] ?>
            <a x-on:click.prevent="open" class="block relative bg-red-100 row-span-2" href="<?= $img ?>">
                <img class="absolute inset-0 w-full h-full object-cover object-center" 
                     src="<?= $img ?>">
            </a>
            
            <?php $img = $urls[4] ?>
            <a x-on:click.prevent="open" class="block relative bg-red-100" href="<?= $img ?>">
                <img class="absolute inset-0 w-full h-full object-cover object-center" 
                     src="<?= $img ?>">
            </a>
            
            <?php $img = $urls[5] ?>
            <a x-on:click.prevent="open" class="block relative bg-red-100 w-36 h-24" href="<?= $img ?>">
                <img class="absolute inset-0 w-full h-full object-cover object-center" 
                     src="<?= $img ?>">
            </a>
            
            <?php $img = $urls[6] ?>
            <a x-on:click.prevent="open" class="block relative bg-red-100 row-span-2" href="<?= $img ?>">
                <img class="absolute inset-0 w-full h-full object-cover object-center" 
                     src="<?= $img ?>">
            </a>
            
            <?php $img = $urls[7] ?>
            <a x-on:click.prevent="open" class="block relative bg-red-100 col-span-2 row-span-2" href="<?= $img ?>">
                <img class="absolute inset-0 w-full h-full object-cover object-center" 
                     src="<?= $img ?>">
            </a>
            
            <?php $img = $urls[8] ?>
            <a x-on:click.prevent="open" class="block relative bg-red-100 row-span-2" href="<?= $img ?>">
                <img class="absolute inset-0 w-full h-full object-cover object-center" 
                     src="<?= $img ?>">
            </a>
            
            <?php $img = $urls[9] ?>
            <a x-on:click.prevent="open" class="block relative bg-red-100" href="<?= $img ?>">
                <img class="absolute inset-0 w-full h-full object-cover object-center" 
                     src="<?= $img ?>">
            </a>
        </div>
        
        <div 
             style="display: none" 
             x-show="isOpen()" 
             x-transition:enter="transition ease-in-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:leave="transition ease-in-in duration-300"
             x-transition:leave-end="opacity-0" 
             x-on:click="close" 
             x-on:keydown.window.escape="close"
             class="fixed inset-0 bg-black bg-opacity-90 flex justify-center items-center"
        >
            <img x-show="isOpen()"
                 x-transition:enter="transition ease-in-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-50"
                 x-transition:leave="transition ease-in-in duration-300"
                 x-transition:leave-end="opacity-0 transform scale-50" 
                 class="w-4/5 h-4/5 object-contain object-center" 
                 x-bind:src="activeImageUrl" 
                 alt="">
        </div>
    </div>

</div>

    <!-- <div class="bg-white dark:bg-slate-900 px-6 py-8 ring-1 ring-slate-900/5 shadow-xl">
        <h1 class="text-slate-900 dark:text-white m-5 text-base font-medium tracking-tight">Hello World</h1>
        <div class="grid grid-flow-col grid-rows-1 grid-cols-1 px-6 h-full">
            <div>
                <img src="data:image/jpeg;base64,<?php echo base64_encode(file_get_contents($imgs[rand(0, count($imgs))])) ?>" alt="">
            </div>
        </div>
    </div> -->
<script>
        
    function gallery() {
        return {
            show: false,
            activeImageUrl: null,
            
            isOpen() {
                return this.show
            },
            
            open($event) {
                this.activeImageUrl = $event.target.parentNode.href
                this.show = true
            },
            
            close() {
                this.show = false
                // Clear the active image URL after the image closed
                setTimeout(() => this.activeImageUrl = null, 300)
            }
        }
    }
</script>
</body>
</html>