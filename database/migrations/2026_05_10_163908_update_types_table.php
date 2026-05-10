<?php

use App\Enums\TypeEnum;
use App\Models\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('types', function (Blueprint $table) {
            $table->string('key')->after('id');
        });

        $types = TypeEnum::cases();

        foreach ($types as $type) {
            Type::where('id', $type->value)->update(['key' => $type->key()]);
        }
    }

    public function down(): void
    {
        Schema::table('types', function (Blueprint $table) {
            $table->dropColumn('key');
        });
    }
};
