<?php


namespace PagSeguro\Http\Transaction;


use Carbon\Carbon;
use Common\Utilities;
use PagSeguro\Http\GetRequest;

class TransactionsRequest extends GetRequest
{
    use Utilities;

    private Carbon $initialDate;
    private ?int $page = null;
    private ?Carbon $finalDate = null;
    private ?string $reference = null;
    private ?int $maxPageResults = null;

    public function getQuery(): array
    {
        return self::not_null([
            'initialDate' => $this->initialDate->toIso8601String(),
            'page' => $this->page,
            'finalDate' => $this->finalDate?->toIso8601String(),
            'reference' => $this->reference,
            'maxPageResults' => $this->maxPageResults,
        ]);
    }

    public function getPath()
    {
        return '/v2/transactions';
    }

    /**
     * @param Carbon $initialDate
     * @return TransactionsRequest
     */
    public function setInitialDate(Carbon $initialDate): TransactionsRequest
    {
        $this->initialDate = $initialDate;
        return $this;
    }

    /**
     * @param int|null $page
     * @return TransactionsRequest
     */
    public function setPage(?int $page): TransactionsRequest
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param Carbon|null $finalDate
     * @return TransactionsRequest
     */
    public function setFinalDate(?Carbon $finalDate): TransactionsRequest
    {
        $this->finalDate = $finalDate;
        return $this;
    }

    /**
     * @param string|null $reference
     * @return TransactionsRequest
     */
    public function setReference(?string $reference): TransactionsRequest
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @param int|null $maxPageResults
     * @return TransactionsRequest
     */
    public function setMaxPageResults(?int $maxPageResults): TransactionsRequest
    {
        $this->maxPageResults = $maxPageResults;
        return $this;
    }
}