$(document).ready(function(){
     var state = 'first';
     var currentVisibleImage = '';
     var stateOneImage = '';
     var stateTwoImage = '';
     var monsters = [
          'monsters-01.png',
          'monsters-02.png',
          'monsters-03.png',
          'monsters-04.png',
          'monsters-05.png',
          'monsters-06.png',
          'monsters-07.png',
          'monsters-08.png',
          'monsters-09.png',
          'monsters-10.png',
          'monsters-11.png',
          'monsters-12.png',
          'monsters-13.png',
          'monsters-14.png',
          'monsters-15.png',
          'monsters-16.png'
     ];

     function shuffle(myArray) {
          var i;
          var shuffledArray = [];
          var randomIndex;
          var numMonsters;

          numMonsters = myArray.length;

          for (i = 0; i < numMonsters; i++) {
               randomIndex = Math.floor((Math.random() * myArray.length) + 1) - 1;
               shuffledArray.push(myArray[randomIndex]);
               myArray.splice(randomIndex, 1);
          }
          return shuffledArray;
     }

     function makeGrid(myMonsters, numRows, numCols) {
          /*   myMonsters is the array of monster image filenames.
          it may contain more filenames than we actually need.
          numRows is the number of rows to be shown on the grid
          numRows is the number of rows to be shown on the grid
          the number of monsters = number of tiles = numRows * numCols
          */

          function makeShuffledMonsterArray(monsterImageList, myRows, myCols) {
               /* returns a shuffled array of myRows * myCols monster image filenames.  each image filename will be in the array exactly twice.  */
               var numMonsters = numRows * numCols;

               monsterImageList = shuffle(monsterImageList);                    /* shuffle the list of monster image filenames */

               monsterImageList.length = numMonsters / 2;                       /* chop off half of the array */

               var monsterList2 = monsterImageList.concat(monsterImageList);    /* add second half (i.e., the duplicate filenames) back. */

               return shuffle(monsterList2);                                    /* return the shuffled array */
          }

          var monsterList = makeShuffledMonsterArray(myMonsters, numRows, numCols);

          var imgTagPart1 = '<img class="monster" src="img/monsters/';
          var imgTagPart2 = '">';
          var imgTag = '';
          var i;

          var m = 1;     /* tile margin in percent.  increase if you want to increase the spacing between the tiles */
          var w = 100 / numCols - 2 * m;

          /* build some strings to faciliate creation of the image tag */
          var divTag1 = '<div ';
          var divTag2 = 'style="width: ' + w + '%; margin: ' + m + '%;" ';
          var divTag3 = 'class="tile animated zoomIn">';
          var divTag4 = '</div>';

          /* create the image tag which will build the HTML needed to show the grid */
          for (i=0; i < monsterList.length; i++) {
               imgTag += divTag1 + divTag2 + divTag3 + imgTagPart1 + monsterList[i] + imgTagPart2 + divTag4;
               // console.log(divTag1 + divTag2 + divTag3 + imgTagPart1 + monsterList[i] + imgTagPart2 + divTag4);
          }

          return imgTag;
     }

     // $('#grid').css('visibility', 'hidden');

     // $('.monsterButton').click(function(){
     // $('#grid').css('visibility', 'visible');
     // $('#buttonContainer').css('visibility', 'hidden');
     // });
     console.log('line1');
     console.log(monsters);
     $('#grid').html(makeGrid(monsters, 2, 2));    /* create HTML grid on M rows and N columns.  the product of M and N must be an even number <= 32.  */
     console.log('grid was created');
     console.log('line2');
     console.log(monsters);
     $('.tile').click(function(){
          console.log('tile was clicked');
          if (state === 'first') {
               stateOneImage = $(this).addClass('open');     /* make visible */
               // console.log(stateOneImage);
               state = 'second';
          } else {
               stateTwoImage = $(this).addClass('open');     /* make visible */
               currentVisibleImage = $(this).find('img').attr('src'); /* filename of image above. */

               if ($(stateOneImage).find('img').attr('src') === $(stateTwoImage).find('img').attr('src')) {
                    $('.open').addClass('matched');
                    $('matched').removeClass('open');
               }
               else {
                    var timeOutID = setTimeout(function(){
                         $('.open:not(.matched)').removeClass('open');     /* finds elements with class 'open' excluding ones which also have 'matched' */
                    }, 1000);
               }

               state = 'first';
          }
     });

     $('#play_again').click(function(){
          // state = 'first';
          console.log('play again button clicked');
          var state = 'first';
          var currentVisibleImage = '';
          var stateOneImage = '';
          var stateTwoImage = '';
          var monsters = [
               'monsters-01.png',
               'monsters-02.png',
               'monsters-03.png',
               'monsters-04.png',
               'monsters-05.png',
               'monsters-06.png',
               'monsters-07.png',
               'monsters-08.png',
               'monsters-09.png',
               'monsters-10.png',
               'monsters-11.png',
               'monsters-12.png',
               'monsters-13.png',
               'monsters-14.png',
               'monsters-15.png',
               'monsters-16.png'
          ];

          $('.tile').removeClass('open').removeClass('matched');
          console.log('before remake grid');
          $('#grid').html(makeGrid(monsters, 2, 2));
          console.log('after remake grid');
     });
});
