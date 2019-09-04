<?php

namespace App\Policies;

use App\User;
use App\Animal;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnimalPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any animals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //未登入也可以看所有動物資料，不需要用到這個方法
    }

    /**
     * Determine whether the user can view the animal.
     *
     * @param  \App\User  $user
     * @param  \App\Animal  $animal
     * @return mixed
     */
    public function view(User $user, Animal $animal)
    {
        //未登入也可以看動物資料，不需要用到這個方法
    }

    /**
     * Determine whether the user can create animals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // 登入後認證授權確認皆可以創建送養動物資料，所以不需要製作這方法
        // 是否有權限操作，請參考前幾天 Victor 的鐵人賽文章。
    }

    /**
     * Determine whether the user can update the animal.
     *
     * @param  \App\User  $user
     * @param  \App\Animal  $animal
     * @return mixed
     */
    public function update(User $user, Animal $animal)
    {
        // 修改動物資料必須檢查，動物是否是由該會員新建的，利用animal 的user_id 判斷
        if ($user->id === $animal->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the animal.
     *
     * @param  \App\User  $user
     * @param  \App\Animal  $animal
     * @return mixed
     */
    public function delete(User $user, Animal $animal)
    {
        // 刪除動物資料必須檢查，動物是否是由該會員新建的，利用animal 的user_id 判斷
        if ($user->id === $animal->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the animal.
     *
     * @param  \App\User  $user
     * @param  \App\Animal  $animal
     * @return mixed
     */
    public function restore(User $user, Animal $animal)
    {
        // 軟體刪除後「復原用」類似丟到資料丟到垃圾桶後，要再把資料救回來時判斷。
        // 因為沒有實作軟刪除的部分，這部分直接空著
    }

    /**
     * Determine whether the user can permanently delete the animal.
     *
     * @param  \App\User  $user
     * @param  \App\Animal  $animal
     * @return mixed
     */
    public function forceDelete(User $user, Animal $animal)
    {
        // 軟體刪除後，強制刪除資料表的動物資料。類似資料丟到垃圾桶後，要永久刪除資料的時判斷的邏輯。
        // 因為沒有實作軟刪除的部分，這部分直接空著
    }
}
