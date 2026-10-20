<?php

namespace App\Policies;

use App\Models\ServiceOffering;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ServiceOfferingPolicy extends CompanyScopedPolicy
{
    public function update(User $user, ServiceOffering $serviceOffering): Response
    {
        return $this->ownsCompany($user, $serviceOffering->company_id);
    }

    public function delete(User $user, ServiceOffering $serviceOffering): Response
    {
        return $this->ownsCompany($user, $serviceOffering->company_id);
    }
}
