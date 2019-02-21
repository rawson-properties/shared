<?php

namespace Rawson\Shared\Models\Traits;

trait CrispAttributes
{
    public function getHasCrispDataAttribute(): bool
    {
        return !!$this->default_agent;
    }

    public function getHasCrispOfficeDataAttribute(): bool
    {
        return !!($this->crisp_company && $this->crisp_job_title && $this->crisp_job_role);
    }

    public function getCrispNicknameAttribute(): string
    {
        return $this->default_agent->name;
    }

    public function getCrispPhoneAttribute(): ?string
    {
        return $this->default_agent->cellphone;
    }

    public function getCrispAvatarAttribute(): ?string
    {
        return $this->default_agent->photo_url_small;
    }

    public function getCrispCompanyAttribute(): string
    {
        return $this->default_agent->office->franchise->NAME;
    }

    public function getCrispJobTitleAttribute(): ?string
    {
        return $this->default_agent->job_title;
    }

    public function getCrispJobRoleAttribute(): string
    {
        return $this->default_agent->office->NAME;
    }
}
