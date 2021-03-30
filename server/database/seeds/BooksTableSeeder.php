<?php

use Illuminate\Database\Seeder;

use App\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                'title' => 'P. G. Wodehouse',
                'cover' => 'http://image1.idreambooks.com/uploads/asset/image/3112653/P-G-Wodehouse-A-Life-in-Letters-28232-c5725f8fca9805891bd3.jpg',
                'category' => 'Non-fiction',
                'author' => 'P.G. Wodehouse & Sophie Ratcliffe',
                'publish_date' => '2013-02-04',
                'description' => 'The definitive edition of the letters—many previously unpublished—of England’s greatest comic writer. P. G. Wodehouse wrote some of the greatest comic masterpieces of all time. So, naturally, we find the same humor and wit in his letters. He offers hilarious accounts of living in England and France, the effects of prohibition, and how to deal with publishers. He even recounts cricket matches played while in a Nazi internment camp (Wodehouse wanted to show the stiff upper lip of the British in the toughest situations). Over the years, Wodehouse corresponded with relatives, friends, and some of the greatest figures of the twentieth century: Agatha Christie, Ira Gershwin, Evelyn Waugh, George Orwell, and Sir Arthur Conan Doyle. The letters are arranged chronologically with intersecting sections of biography written by Sophie Ratcliffe. This is the only book you will need to understand the man behind the characters.',
            ],
            [
                'title' => 'Moonwalking With Einstein',
                'cover' => 'http://image4.idreambooks.com/uploads/asset/image/3122827/Moonwalking-With-Einstein-19-29580beba7f8be9192c6.jpg',
                'category' => 'Non-fiction',
                'author' => 'Joshua Foer',
                'publish_date' => '2011-03-03',
                'description' => 'The blockbuster phenomenon that charts an amazing journey of the mind while revolutionizing our concept of memory.An instant bestseller that is poised to become a classic, Moonwalking with Einstein recounts Joshua Foer\'s yearlong quest to improve his memory under the tutelage of top \'mental athletes\'. He draws on cutting-edge research, a surprising cultural history of remembering, and venerable tricks of the mentalist\'s trade to transform our understanding of human memory. From the United States Memory Championship to deep within the author\'s own mind, this is an electrifying work of journalism that reminds us that, in every way that matters, we are the sum of our memories.',
            ],
            [
                'title' => 'Steve Jobs',
                'cover' => 'http://image2.idreambooks.com/uploads/asset/image/3122812/Steve-Jobs-5-be62e51b2d691fe0b5f9.jpg',
                'category' => 'Non-fiction',
                'author' => 'Walter Isaacson',
                'publish_date' => '2011-10-24',
                'description' => 'FROM THE AUTHOR OF THE BESTSELLING BIOGRAPHIES OF BENJAMIN FRANKLIN AND ALBERT EINSTEIN, THIS IS THE EXCLUSIVE BIOGRAPHY OF STEVE JOBS. Based on more than forty interviews with Jobs conducted over two years—as well as interviews with more than a hundred family members, friends, adversaries, competitors, and colleagues—Walter Isaacson has written a riveting story of the roller-coaster life and searingly intense personality of a creative entrepreneur whose passion for perfection and ferocious drive revolutionized six industries: personal computers, animated movies, music, phones, tablet computing, and digital publishing. At a time when America is seeking ways to sustain its innovative edge, and when societies around the world are trying to build digital-age economies, Jobs stands as the ultimate icon of inventiveness and applied imagination. He knew that the best way to create value in the twenty-first century was to connect creativity with technology. He built a company where leaps of the imagination were combined with remarkable feats of engineering. Although Jobs cooperated with this book, he asked for no control over what was written nor even the right to read it before it was published. He put nothing off-limits. He encouraged the people he knew to speak honestly. And Jobs speaks candidly, sometimes brutally so, about the people he worked with and competed against. His friends, foes, and colleagues provide an unvarnished view of the passions, perfectionism, obsessions, artistry, devilry, and compulsion for control that shaped his approach to business and the innovative products that resulted. Driven by demons, Jobs could drive those around him to fury and despair. But his personality and products were interrelated, just as Apple’s hardware and software tended to be, as if part of an integrated system. His tale is instructive and cautionary, filled with lessons about innovation, character, leadership, and values.',
            ],
            [
                'title' => 'Elon Musk',
                'cover' => 'http://image4.idreambooks.com/uploads/asset/image/3136155/Elon-Musk-Tesla-SpaceX-and-the-Quest-for-a-Fantasti-1074527-973d7dafefc8a927204d.jpg',
                'category' => 'Non-fiction',
                'author' => 'Ashlee Vance',
                'publish_date' => '2015-05-19',
                'description' => 'In Elon Musk: Tesla, SpaceX, and the Quest for a Fantastic Future, veteran technology journalist Ashlee Vance provides the first inside look into the extraordinary life and times of Silicon Valley\'s most audacious entrepreneur. Written with exclusive access to Musk, his family and friends, the book traces the entrepreneur\'s journey from a rough upbringing in South Africa to the pinnacle of the global business world. Vance spent over 40 hours in conversation with Musk and interviewed close to 300 people to tell the tumultuous stories of Musk\'s world-changing companies: PayPal, Tesla Motors, SpaceX and SolarCity, and to characterize a man who has renewed American industry and sparked new levels of innovation while making plenty of enemies along the way. Vance uses Musk\'s story to explore one of the pressing questions of our time: can the nation of inventors and creators which led the modern world for a century still compete in an age of fierce global competition? He argues that Musk--one of the most unusual and striking figures in American business history--is a contemporary amalgam of legendary inventors and industrialists like Thomas Edison, Henry Ford, Howard Hughes, and Steve Jobs. More than any other entrepreneur today, Musk has dedicated his energies and his own vast fortune to inventing a future that is as rich and far-reaching as the visionaries of the golden age of science-fiction fantasy.',
            ],
            [
                'title' => 'Becoming Steve Jobs',
                'cover' => 'http://image4.idreambooks.com/uploads/asset/image/3138156/Becoming-Steve-Jobs-The-Evolution-of-a-Reckless-Ups-1134167-0f626b959b0087d4f08c.jpg',
                'category' => 'Non-fiction',
                'author' => 'Brent Schlender',
                'publish_date' => '2015-03-24',
                'description' => '#1 New York Times Bestseller. There have been many books—on a large and small scale—about Steve Jobs, one of the most famous CEOs in history. But this book is different from all the others. Becoming Steve Jobs takes on and breaks down the existing myth and stereotypes about Steve Jobs. The conventional, one-dimensional view of Jobs is that he was half-genius, half-jerk from youth, an irascible and selfish leader who slighted friends and family alike. Becoming Steve Jobs answers the central question about the life and career of the Apple cofounder and CEO: How did a young man so reckless and arrogant that he was exiled from the company he founded become the most effective visionary business leader of our time, ultimately transforming the daily life of billions of people? Drawing on incredible and sometimes exclusive access, Schlender and Tetzeli tell a different story of a real human being who wrestled with his failings and learned to maximize his strengths over time. Their rich, compelling narrative is filled with stories never told before from the people who knew Jobs best, and who decided to open up to the authors, including his family, former inner circle executives, and top people at Apple, Pixar and Disney, most notably Tim Cook, Jony Ive, Eddy Cue, Ed Catmull, John Lasseter, Robert Iger and many others. In addition, Brent knew Jobs personally for 25 years and draws upon his many interviews with him, on and off the record, in writing the book. He and Rick humanize the man and explain, rather than simply describe, his behavior. Along the way, the book provides rich context about the technology revolution we all have lived through, and the ways in which Jobs changed our world. Schlender and Tetzeli make clear that Jobs\'s astounding success at Apple was far more complicated than simply picking the right products: he became more patient, he learned to trust his inner circle, and discovered the importance of growing the company incrementally rather than only shooting for dazzling game-changing products. A rich and revealing account that will change the way we view Jobs, Becoming Steve Jobs shows us how one of the most colorful and compelling figures of our times was able to combine his unchanging, relentless passion with a more mature management style to create one of the most valuable and beloved companies on the planet. From the Hardcover edition.',
            ],
        ];

        foreach($books as $book){
            Book::create($book);
        };
    }
}
