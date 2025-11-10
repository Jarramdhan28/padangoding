<?php

namespace App\Enums;

enum ArticleStatus: string
{
    CASE DRAFT = 'draft';
    CASE REVIEW = 'review';
    CASE APPROVED = 'approved';
    CASE REJECTED = 'rejected';

    public function label(): string
    {
        return match($this){
            self::DRAFT => 'Draft',
            self::REVIEW => 'Review',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
        };
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::DRAFT => 'border border-gray-200 text-gray-900 bg-blue-100',
            self::REVIEW => 'border border-yellow-500 text-white bg-yellow-500',
            self::APPROVED => 'border border-green-500 text-white bg-green-500',
            self::REJECTED => 'border border-red-500 text-white bg-red-500',
        };
    }
}
