import { Role } from './role.model';
import { File } from './file.model';

export interface Profile {
  username: string;
  bio: string;
  image: string;
  following: boolean;
  role?: Role;
  file?: File;
}
