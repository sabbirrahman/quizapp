<?php

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    public function run()
    {
    	DB::table("options")->delete();

    	Option::create([ 'question_id' => 1, 'option' => 'Apple'     ]);
    	Option::create([ 'question_id' => 1, 'option' => 'Ball' 	 ]);
    	Option::create([ 'question_id' => 1, 'option' => 'Cat' 		 ]);
    	Option::create([ 'question_id' => 1, 'option' => 'Dog' 		 ]);
    	Option::create([ 'question_id' => 2, 'option' => 'Mouse' 	 ]);
    	Option::create([ 'question_id' => 2, 'option' => 'Tiger' 	 ]);
    	Option::create([ 'question_id' => 2, 'option' => 'Bear' 	 ]);
    	Option::create([ 'question_id' => 2, 'option' => 'Lion' 	 ]);
    	Option::create([ 'question_id' => 3, 'option' => 'Pink' 	 ]);
    	Option::create([ 'question_id' => 3, 'option' => 'Cool' 	 ]);
    	Option::create([ 'question_id' => 3, 'option' => 'Hot' 		 ]);
    	Option::create([ 'question_id' => 3, 'option' => 'Yellow' 	 ]);
    	Option::create([ 'question_id' => 4, 'option' => 'Red'  	 ]);
    	Option::create([ 'question_id' => 4, 'option' => 'Cheetah'   ]);
    	Option::create([ 'question_id' => 4, 'option' => 'Temporary' ]);
    	Option::create([ 'question_id' => 4, 'option' => 'Digital'   ]);
    	Option::create([ 'question_id' => 5, 'option' => 'RAM' 		 ]);
    	Option::create([ 'question_id' => 5, 'option' => 'ECMAScript']);
    	Option::create([ 'question_id' => 5, 'option' => 'Bother' 	 ]);
    	Option::create([ 'question_id' => 5, 'option' => 'Mother' 	 ]);
    	Option::create([ 'question_id' => 6, 'option' => 'Father' 	 ]);
    	Option::create([ 'question_id' => 6, 'option' => 'Zoo' 		 ]);
    	Option::create([ 'question_id' => 6, 'option' => 'PHP' 		 ]);
    	Option::create([ 'question_id' => 6, 'option' => 'Laravel'	 ]);
    }
}
