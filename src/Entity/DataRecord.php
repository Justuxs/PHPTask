<?php

namespace App\Entity;

use App\Repository\DataRecordRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DataRecordRepository::class)]
class DataRecord
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: false)]
    private string $transactionId;


    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private string $toolNumber;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 7, nullable: false)]
    private float $latitude;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 7, nullable: false)]
    private float $longitude;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private \DateTimeInterface $recordDate;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private ?float $batPercentage = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $importDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function setTransactionId(string $transactionId): self
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    public function getToolNumber(): string
    {
        return $this->toolNumber;
    }

    public function setToolNumber(string $toolNumber): self
    {
        $this->toolNumber = $toolNumber;
        return $this;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getRecordDate(): \DateTimeInterface
    {
        return $this->recordDate;
    }

    public function setRecordDate(\DateTimeInterface $recordDate): self
    {
        $this->recordDate = $recordDate;
        return $this;
    }

    public function getBatPercentage(): ?float
    {
        return $this->batPercentage;
    }

    public function setBatPercentage(?float $batPercentage): self
    {
        $this->batPercentage = $batPercentage;
        return $this;
    }

    public function getImportDate(): ?\DateTimeInterface
    {
        return $this->importDate;
    }

    public function setImportDate(?\DateTimeInterface $importDate): self
    {
        $this->importDate = $importDate;
        return $this;
    }
}
