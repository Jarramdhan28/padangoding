<?php

namespace App\Enums;

enum ArticleStatus: string
{
    CASE DRAFT = 'draft';
    CASE REVIEW = 'review';
    CASE APROVED = 'aproved';
    CASE REJECTED = 'rejected';

    public function label(): string
    {
        return match($this){
            self::DRAFT => 'Draft',
            self::REVIEW => 'Review',
            self::APROVED => 'Disetujui',
            self::REJECTED => 'Ditolak',
        };
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::DRAFT => 'border border-gray-200 text-gray-900 bg-blue-100',
            self::REVIEW => 'border border-yellow-500 text-white bg-yellow-500',
            self::APROVED => 'border border-green-500 text-white bg-green-500',
            self::REJECTED => 'border border-red-500 text-white bg-red-500',
        };
    }
}
