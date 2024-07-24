<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $category_id
 * @property int $outlet_id
 * @property string $category_name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Outlet $outlet
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category categoryByOutlet($slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category withoutTrashed()
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $category_id
 * @property int $product_id
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProduct whereProductId($value)
 */
	class CategoryProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $meja_id
 * @property int $outlet_id
 * @property string $nomor_meja
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Outlet $outlet
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pesanan> $pesanans
 * @property-read int|null $pesanans_count
 * @method static \Database\Factories\MejaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Meja mejaByOutlet($slug = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Meja newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meja newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meja onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Meja query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meja whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meja whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meja whereMejaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meja whereNomorMeja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meja whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meja whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meja withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Meja withoutTrashed()
 */
	class Meja extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $outlet_id
 * @property int $supervisor_id
 * @property string $outlet_name
 * @property string $slug
 * @property string $address
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meja> $mejas
 * @property-read int|null $mejas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SalesHistory> $salesHistories
 * @property-read int|null $sales_histories_count
 * @property-read \App\Models\User $supervisor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Supplier> $suppliers
 * @property-read int|null $suppliers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tax> $taxs
 * @property-read int|null $taxs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\OutletFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet whereOutletName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet whereSupervisorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Outlet withoutTrashed()
 */
	class Outlet extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $pesanan_id
 * @property int $product_id
 * @property int $meja_id
 * @property int $quantity
 * @property int $total
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Meja $meja
 * @property-read \App\Models\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SalesHistory> $salesHistories
 * @property-read int|null $sales_histories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pesanan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pesanan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pesanan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pesanan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesanan whereMejaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesanan wherePesananId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesanan whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesanan whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesanan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesanan whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesanan whereUpdatedAt($value)
 */
	class Pesanan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $product_id
 * @property int $user_id
 * @property int $supplier_id
 * @property int $outlet_id
 * @property string $slug
 * @property string $product_name
 * @property int $price
 * @property int $status
 * @property int $stock
 * @property string $gambar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\Outlet $outlet
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pesanan> $pesanans
 * @property-read int|null $pesanans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SalesHistory> $salesHistories
 * @property-read int|null $sales_histories_count
 * @property-read \App\Models\Supplier $supplier
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Varian> $varians
 * @property-read int|null $varians_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereGambar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product withoutTrashed()
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $sales_history_id
 * @property int $product_id
 * @property int $user_id
 * @property int $outlet_id
 * @property int $pesanan_id
 * @property int $quantity
 * @property int $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Outlet $outlet
 * @property-read \App\Models\Pesanan $pesanan
 * @property-read \App\Models\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SalesHistoryTax> $salesHistoryTax
 * @property-read int|null $sales_history_tax_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tax> $taxs
 * @property-read int|null $taxs_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory wherePesananId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereSalesHistoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistory whereUserId($value)
 */
	class SalesHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $sales_history_tax_id
 * @property int $sales_history_id
 * @property int $tax_id
 * @property int $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistoryTax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistoryTax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistoryTax query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistoryTax whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistoryTax whereSalesHistoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistoryTax whereSalesHistoryTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistoryTax whereTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistoryTax whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesHistoryTax whereUpdatedAt($value)
 */
	class SalesHistoryTax extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $supplier_id
 * @property int $user_id
 * @property int $outlet_id
 * @property string $supplier_name
 * @property string $slug
 * @property string $phone
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Outlet $outlet
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\SupplierFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereSupplierName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUserId($value)
 */
	class Supplier extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $tax_id
 * @property int $outlet_id
 * @property string $tax_name
 * @property string $tax_rate
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Outlet $outlet
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SalesHistory> $salesHistories
 * @property-read int|null $sales_histories_count
 * @method static \Database\Factories\TaxFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Tax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereTaxName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereTaxRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tax whereUpdatedAt($value)
 */
	class Tax extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $user_id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property int|null $supervisor_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $outletHasCategory
 * @property-read int|null $outlet_has_category_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Outlet> $outletWorks
 * @property-read int|null $outlet_works_count
 * @property-read User|null $pegawai
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SalesHistory> $salesHistories
 * @property-read int|null $sales_histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $supervisor
 * @property-read int|null $supervisor_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Outlet> $supervisorHasOutlets
 * @property-read int|null $supervisor_has_outlets_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Supplier> $suppliers
 * @property-read int|null $suppliers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meja> $userHasOutletHasMeja
 * @property-read int|null $user_has_outlet_has_meja_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSupervisorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $user_id
 * @property int $outlet_id
 * @method static \Illuminate\Database\Eloquent\Builder|UserOutlet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserOutlet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserOutlet query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserOutlet whereOutletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserOutlet whereUserId($value)
 */
	class UserOutlet extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $varian_id
 * @property int $product_id
 * @property int $meja_id
 * @property string $varian_name
 * @property string $price
 * @property string $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|Varian newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Varian newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Varian query()
 * @method static \Illuminate\Database\Eloquent\Builder|Varian whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Varian whereMejaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Varian wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Varian whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Varian whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Varian whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Varian whereVarianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Varian whereVarianName($value)
 */
	class Varian extends \Eloquent {}
}

