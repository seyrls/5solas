<?php
/**
 * Created by PhpStorm.
 * User: seyr
 * Date: 22/08/16
 * Time: 14:09
 */

namespace App\Library;

use App\Category;
use App\Member;
use App\Type;
use App\Subcategory;
use App\Account;
use App\Family;

class Combobox
{
    public function getComboBoxTypes($id = null){
        $html = '<select name="type_id" id="type_id" required>';

        if ($id == null){
            $data = Type::all();
            $html .='<option value="" selected>'.trans('messages.option').'</option>';

            foreach ($data as $d){
                $html .="<option value=\"$d->id\">$d->type</option>";
            }
        }else{
            $data = Type::all();
            foreach ($data as $d){
                if ($d->id != $id){
                    $html .="<option value=\"$d->id\">$d->type</option>";
                }else{
                    $html .="<option value=\"$d->id\" selected>$d->type</option>";
                }
            }
        }

        $html .= '</select>';

        return (string)$html;

    }

    public function getComboBoxFamily($id = null){
        $html = null;

        $html = '<select name="family_id" id="family_id" required>';

        if ($id == null){
            $data = Family::all();
            $html .='<option value="" selected>'.trans('messages.option').'</option>';
            foreach ($data as $d){
                $html .="<option value=\"$d->id\">$d->name</option>";
            }
        }else{
            $data = Family::all();
            foreach ($data as $d){
                if ($d->id != $id){
                    $html .="<option value=\"$d->id\">$d->name</option>";
                }else{
                    $html .="<option value=\"$d->id\" selected>$d->name</option>";
                }
            }
        }

        $html .= '</select>';

        return (string)$html;
    }

    public function getJqueryFamily($id = null){
        $html = null;

        $html = '<select name="family_id" id="family_id" required>';

        if ($id == null){
            $data = Family::all();
            $html .='<option value="" selected>'.trans('messages.option').'</option>';
            foreach ($data as $d){
                $html .="<option value=\"$d->id\">$d->name</option>";
            }
        }else{
            $data = Member::find($id)->family()->get();
            foreach ($data as $d){
                if ($d->id != $id){
                    $html .="<option value=\"$d->id\">$d->name</option>";
                }else{
                    $html .="<option value=\"$d->id\" selected>$d->name</option>";
                }
            }
        }

        $html .= '</select>';

        return (string)$html;
    }

    public function getComboBoxMember($id = null){
        $html = null;

        $html = '<select name="member_id" id="member_id" required>';

        if ($id == null){
            $data = Member::all();
            $html .='<option value="" selected>'.trans('messages.option').'</option>';
            foreach ($data as $d){
                $html .="<option value=\"$d->id\">$d->name</option>";
            }
        }else{
            $data = Member::all();
            foreach ($data as $d){
                if ($d->id != $id){
                    $html .="<option value=\"$d->id\">$d->name</option>";
                }else{
                    $html .="<option value=\"$d->id\" selected>$d->name</option>";
                }
            }
        }

        $html .= '</select>';

        return (string)$html;
    }

    public function getJqueryMember($id){
        $obj = new Member();
        $html = null;
        $html = '<select name="member_id" id="member_id" required>';

        $data = $obj->getMembers($id);

        foreach ($data as $d){
            if ($d->id != $id){
                $html .="<option value=\"$d->id\">$d->name</option>";
            }else{
                $html .="<option value=\"$d->id\" selected>$d->name</option>";
            }

        }

        $html .= '</select>';

        return (string)$html;
    }

    public function getComboBoxCategory($id = null){
        $html = null;

        $html = '<select name="category_id" id="category_id" required>';

        if ($id == null){
            $data = Category::all();
            $html .='<option value="" selected>'.trans('messages.option').'</option>';
            foreach ($data as $d){
                $html .="<option value=\"$d->id\">$d->category</option>";
            }
        }else{
            $data = Category::all();
            foreach ($data as $d){
                if ($d->id != $id){
                    $html .="<option value=\"$d->id\">$d->category</option>";
                }else{
                    $html .="<option value=\"$d->id\" selected>$d->category</option>";
                }
            }
        }

        $html .= '</select>';

        return (string)$html;
    }

    public function getComboBoxSubCategory($id = null){
        $html = null;

        $html = '<select name="subcategory_id" id="subcategory_id" required>';

        if ($id == null){
            $data = Subcategory::all();
            $html .='<option value="" selected>'.trans('messages.option').'</option>';
            foreach ($data as $d){
                $html .="<option value=\"$d->id\">$d->subcategory</option>";
            }
        }else{
            $data = Subcategory::all();
            foreach ($data as $d){
                if ($d->id != $id){
                    $html .="<option value=\"$d->id\">$d->subcategory</option>";
                }else{
                    $html .="<option value=\"$d->id\" selected>$d->subcategory</option>";
                }
            }
        }

        $html .= '</select>';

        return (string)$html;
    }

    public function getJquerySubCategory($id = null){
        $html = null;
        $obj = new Subcategory();

        $html = '<select name="subcategory_id" id="subcategory_id" required>';

        if ($id == null){
            $data = Subcategory::all();
            $html .='<option value="" selected>'.trans('messages.option').'</option>';
            foreach ($data as $d){
                $html .="<option value=\"$d->id\">$d->subcategory</option>";
            }
        }else{
            $data = $obj->getSubcategories($id);
            foreach ($data as $d){
                if ($d->id != $id){
                    $html .="<option value=\"$d->id\">$d->subcategory</option>";
                }else{
                    $html .="<option value=\"$d->id\" selected>$d->subcategory</option>";
                }
            }
        }

        $html .= '</select>';

        return (string)$html;
    }

    public function getComboBoxAccount($id = null){
        $html = null;

        $html = '<select name="account_id" id="account_id" required>';

        if ($id == null){
            $data = Account::all();
            $html .='<option value="" selected>'.trans('messages.option').'</option>';

            foreach ($data as $d){
                $html .="<option value=\"$d->id\">$d->account_name</option>";
            }
        }else{
            $data = Account::all();
            foreach ($data as $d){
                if ($d->id != $id){
                    $html .="<option value=\"$d->id\">$d->account_name</option>";
                }else{
                    $html .="<option value=\"$d->id\" selected>$d->account_name</option>";
                }
            }
        }

        $html .= '</select>';

        return (string)$html;
    }
}