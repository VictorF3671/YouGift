import { Injectable } from '@angular/core';
import { IGiftCard } from '../home/IGiftCardHome';

@Injectable({
  providedIn: 'root',
})
export class GiftTransferService {
  private giftCard: IGiftCard | null = null;

  setGift(gift: IGiftCard) {
    this.giftCard = gift;
  }

  getGift(): IGiftCard | null {
    return this.giftCard;
  }

  clear() {
    this.giftCard = null;
  }
}
