import { TestBed } from '@angular/core/testing';
import { GiftTransferService } from './gift-transfer.service';

describe('GiftTransferService', () => {
  let service: GiftTransferService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(GiftTransferService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
