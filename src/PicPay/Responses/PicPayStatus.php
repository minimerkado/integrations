<?php


namespace PicPay\Responses;


class PicPayStatus
{
    const CREATED = 'created';
    const EXPIRED = 'expired';
    const ANALYSIS = 'analysis';
    const PAID = 'paid';
    const COMPLETED = 'completed';
    const REFUNDED = 'refunded';
    const CHARGEBACK = 'chargeback';
}